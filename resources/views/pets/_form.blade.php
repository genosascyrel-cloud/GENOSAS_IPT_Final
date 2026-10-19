<div class="row">
    <div class="col-md-6"><x-field name="name" label="Pet Name" :value="$item->name ?? ''" required /></div>
    <div class="col-md-6"><x-select name="owner_id" label="Owner" :options="$owners" :selected="$item->owner_id ?? $preselected" required /></div>
</div>
<div class="row">
    <div class="col-md-4"><x-select name="species" label="Species" :options="$species" :selected="$item->species ?? null" required /></div>
    <div class="col-md-4"><x-field name="breed" label="Breed" :value="$item->breed ?? ''" /></div>
    <div class="col-md-4"><x-select name="sex" label="Sex" :options="['Male' => 'Male', 'Female' => 'Female']" :selected="$item->sex ?? null" required /></div>
</div>
<div class="row">
    <div class="col-md-6"><x-field name="birth_date" label="Birth Date" type="date" :max="now()->format('Y-m-d')" :value="isset($item) && $item->birth_date ? $item->birth_date->format('Y-m-d') : ''" /></div>
    <div class="col-md-6"><x-field name="weight_kg" label="Weight (kg)" type="number" step="0.01" :value="$item->weight_kg ?? ''" /></div>
</div>
<button class="btn btn-success"><i class="bi bi-save"></i> Save</button>
<a href="{{ route('pets.index') }}" class="btn btn-secondary">Cancel</a>
