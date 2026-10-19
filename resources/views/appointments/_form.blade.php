<div class="row">
    <div class="col-md-6"><x-select name="pet_id" label="Pet" :options="$pets" :selected="$item->pet_id ?? $preselected" required /></div>
    <div class="col-md-6"><x-select name="veterinarian_id" label="Veterinarian" :options="$vets" :selected="$item->veterinarian_id ?? null" required /></div>
</div>
<div class="row">
    <div class="col-md-6"><x-field name="appointment_date" label="Date & Time" type="datetime-local" :value="isset($item) ? $item->appointment_date->format('Y-m-d\TH:i') : ''" required /></div>
    <div class="col-md-6"><x-select name="status" label="Status" :options="$statuses" :selected="$item->status ?? 'Scheduled'" required /></div>
</div>
<x-field name="reason" label="Reason for Visit" :value="$item->reason ?? ''" required />
<x-field name="notes" label="Notes" type="textarea" :value="$item->notes ?? ''" />
<button class="btn btn-success"><i class="bi bi-save"></i> Save</button>
<a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
