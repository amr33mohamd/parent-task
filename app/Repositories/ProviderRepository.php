<?php

namespace App\Repositories;

use App\Models\Provider;

class ProviderRepository
{
   

    /**
     * ProviderRepository constructor.
     *
     * @param Provider $provider
     */
    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }
   

    public function getPrividerByName($name)
    {
        return Provider::where('name',$name)->first();
    }
    

    public function deleteProvider($id){
        return Provider::destroy($id);
    }

    public function createProvider(array $providerDetails)
    {
        return Provider::create($providerDetails);
    }
    

    public function updateProvider($id, array $newDetails)
    {
           $provider =  Provider::where('id',$id)->first();
           $provider->update($newDetails);
           return $provider;
    }
   
}
