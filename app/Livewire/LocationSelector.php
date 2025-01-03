<?php

namespace App\Livewire;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class LocationSelector extends Component
{
    public $provinces;
    public $regencies = [];
    public $districts = [];
    public $villages = [];

    public $selectedProvince = null;
    public $selectedRegency = null;
    public $selectedDistrict = null;
    public $selectedVillage = null;

    public function mount()
    {
        // Initialize provinces
        $this->provinces = Province::all();
    }

    public function updatedSelectedProvince($provinceId)
    {
        $this->regencies = Regency::where('province_id', $provinceId)->get();
        $this->districts = [];
        $this->villages = [];
        $this->selectedRegency = null;
        $this->selectedDistrict = null;
        $this->selectedVillage = null;
    }

    public function updatedSelectedRegency($regencyId)
    {
        $this->districts = District::where('regency_id', $regencyId)->get();
        $this->villages = [];
        $this->selectedDistrict = null;
        $this->selectedVillage = null;
    }

    public function updatedSelectedDistrict($districtId)
    {
        $this->villages = Village::where('district_id', $districtId)->get();
        $this->selectedVillage = null;
    }

    
    public function render()
    {
        return view('livewire.location-selector');
    }
}
