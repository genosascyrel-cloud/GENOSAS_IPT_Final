<div class="row">
    <div class="col-md-6"><x-field name="first_name" label="First Name" :value="$item->first_name ?? ''" required /></div>
    <div class="col-md-6"><x-field name="last_name" label="Last Name" :value="$item->last_name ?? ''" required /></div>
</div>
<div class="row">
    <div class="col-md-6"><x-field name="phone" label="Phone" :value="$item->phone ?? ''" required /></div>
    <div class="col-md-6"><x-field name="email" label="Email" type="email" :value="$item->email ?? ''" /></div>
</div>
<x-field name="address" label="Address" :value="$item->address ?? ''" />
<button class="btn btn-success"><i class="bi bi-save"></i> Save</button>
<a href="{{ route('owners.index') }}" class="btn btn-secondary">Cancel</a>
