<x-field name="name" label="Full Name" :value="$item->name ?? ''" required />
<div class="row">
    <div class="col-md-6"><x-field name="specialization" label="Specialization" :value="$item->specialization ?? ''" required /></div>
    <div class="col-md-6"><x-field name="license_number" label="License Number" :value="$item->license_number ?? ''" required /></div>
</div>
<div class="row">
    <div class="col-md-6"><x-field name="phone" label="Phone" :value="$item->phone ?? ''" /></div>
    <div class="col-md-6"><x-field name="email" label="Email" type="email" :value="$item->email ?? ''" /></div>
</div>
<button class="btn btn-success"><i class="bi bi-save"></i> Save</button>
<a href="{{ route('veterinarians.index') }}" class="btn btn-secondary">Cancel</a>
