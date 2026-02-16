<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Http\UploadedFile;       
use Illuminate\Support\Facades\Storage;

class EquipService
{
    public function __construct(private BaseRepository $repository) {}

    public function llistar()
    {
        return $this->repository->getAll();
    }


    public function guardar(array $data, ?UploadedFile $escut = null)
    {
        if ($escut) {

            $data['escut'] = $escut->store('escuts', 'public');
        }
        
        return $this->repository->create($data);
    }


    public function actualitzar($id, array $data, ?UploadedFile $escut = null)
    {
        $equip = $this->repository->find($id);

        if ($escut) {
            if ($equip->escut) {
                Storage::disk('public')->delete($equip->escut);
            }
            
            $data['escut'] = $escut->store('escuts', 'public');
        }

        return $this->repository->update($id, $data);
    }

    public function eliminar($id)
    {
        $equip = $this->repository->find($id);

        if ($equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }

        return $this->repository->delete($id);
    }

    public function trobar($id)
    {
        return $this->repository->find($id);
    }
}