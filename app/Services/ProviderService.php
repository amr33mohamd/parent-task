<?php


namespace App\Services;

use App\Models\Provider;
use App\Repositories\ProviderRepository;


class UserService
{
    
    /**
     * ProviderService constructor.
     *
     * @param providerRepository $providerRepository
     */
    public function __construct(ProviderRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }
    
    public function getPreoviderByName($name)
    {
        return $this->providerRepository->getPrividerByName($name);
    }
    public function createProvider(array $providerDetails)
    {
        return $this->providerRepository->createProvider($providerDetails);
    }
    public function updateProvider($id, array $newDetails)
    {
       return $this->providerRepository->updateProvider($id,$newDetails);

    }
    public function deleteProvider($id)
    {
        return $this->providerRepository->deleteProvider($id);

    }
}
