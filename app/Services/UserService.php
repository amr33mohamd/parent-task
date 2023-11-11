<?php


namespace App\Services;

use App\Models\User;
use App\Repositories\ProviderRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class UserService
{
   
    /**
     * UserService constructor.
     *
     * @param userRepository $userRepository
     */
    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }
    

   
    public function getUsers($request)
    {

         // Define cache key based on request parameters
         $cacheKey = 'api_users_' . md5(serialize($request->query()));
         // Check if cached data is available
         if (Cache::has($cacheKey)) {
             return response()->json(Cache::get($cacheKey));
         }
        $data = [];
        foreach($request->all() as $key =>$file){
            if($this->providerRepository->getPrividerByName($key)){
                $provider = $this->providerRepository->getPrividerByName($key);
               $dataPart = $this->readAndParseJSONChunked($request->file($key),  $provider,$request);
                $data = array_merge($data,$dataPart);
            }
        }

         // Convert to Laravel collection for additional processing
         $usersCollection = new Collection($data);

         // Pagination
         $page = $request->input('page', 1);
         $perPage = $request->input('per_page', 10);
 
         $paginatedData = $usersCollection->forPage($page, $perPage);
 
         // Cache the filtered data for future requests
         Cache::put($cacheKey, $paginatedData, now()->addMinutes(60)); // Cache for 60 minutes
         return response()->json($paginatedData);

    }
    public function readAndParseJSONChunked($filePath, $provider,$request)
    {
        $users = [];
        
        $handle = fopen($filePath->getRealPath(), 'r');
        $buffer = '';
        while (($line = fgets($handle)) !== false) {
            $buffer = $buffer . $line;
            
            if (strpos($buffer, '}') !== false) {
                // Decode the JSON chunk
                    $buffer = str_replace('[','',$buffer);
                    $buffer = str_replace(']','',$buffer);
    
                  if(strpos($buffer, '},') !== false){
                    $chunk = json_decode(str_replace('},','}',$buffer), true);
                  }
                  else{
                    $chunk = json_decode($buffer, true);
                  }
                

             if (!empty($chunk) ) {
                $chunk = $this->unifyUserParamters($chunk,$provider);
                if ($this->passesFilters($chunk, $request)) {
                $users[] = $chunk;
                }

             }
                $buffer = '';
        }
        }

        fclose($handle);

        return $users;
    }
  
        
        public function unifyUserParamters($user,$provider){
            $user2 = [];
            $user2['provider'] = $provider['name'];
            $user2['status'] = $user[$provider['status']] == $provider['authorised'] ? "authorised" : ($user[$provider['status']] == $provider['declined'] ? "decline" : "refunded");
            $user2['balance'] = $user[$provider['balance']];
            $user2['currency'] = $user[$provider['currency']];
            $user2['id'] = $user[$provider['identification']];
            $user2['created_at'] = Carbon::createFromFormat($provider['created_at_format'], $user[$provider['created_at']])->format("Y-m-d");
            return $user2;
        }
    
        public function passesFilters($user, $request)
        {
            if ($request->has('provider') && $user['provider'] !== $request->input('provider')) {
                return false;
            }
    
            if ($request->has('statusCode') && $user['status'] !== $request->input('statusCode')) {
                return false;
            }
    
            if (($request->has('balanceMin') || $request->has('balanceMax')) &&
                ($user['balance'] < $request->input('balanceMin') || $user['balance'] > $request->input('balanceMax'))
            ) {
                return false;
            }
    
            if ($request->has('currency') && $user['currency'] !== $request->input('currency')) {
                return false;
            }
    
            return true;
        }

}
