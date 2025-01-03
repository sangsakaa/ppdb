<div>
    <div>
        <h3>Select Province</h3>
        <select name="province" id="province" class="form-control" wire:model="selectedProvince">
            <option value="">-- Select Province --</option>
            @foreach($provinces as $province)
            <option value="{{ $province->id }}" {{ $province->id == $selectedProvince ? 'selected' : '' }}>
                {{ $province->name }}
            </option>
            @endforeach
        </select>

        <h3>Select Regency</h3>
        <select name="regency" id="regency" class="form-control" wire:model="selectedRegency">
            <option value="">-- Select Regency --</option>
            @foreach($regencies as $regency)
            <option value="{{ $regency->id }}" {{ $regency->id == $selectedRegency ? 'selected' : '' }}>
                {{ $regency->name }}
            </option>
            @endforeach
        </select>

        <h3>Select District</h3>
        <select name="district" id="district" class="form-control" wire:model="selectedDistrict">
            <option value="">-- Select District --</option>
            @foreach($districts as $district)
            <option value="{{ $district->id }}" {{ $district->id == $selectedDistrict ? 'selected' : '' }}>
                {{ $district->name }}
            </option>
            @endforeach
        </select>

        <h3>Select Village</h3>
        <select name="village" id="village" class="form-control" wire:model="selectedVillage">
            <option value="">-- Select Village --</option>
            @foreach($villages as $village)
            <option value="{{ $village->id }}" {{ $village->id == $selectedVillage ? 'selected' : '' }}>
                {{ $village->name }}
            </option>
            @endforeach
        </select>
    </div>

</div>