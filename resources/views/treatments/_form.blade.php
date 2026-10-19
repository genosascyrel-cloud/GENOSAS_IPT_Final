<x-select name="appointment_id" label="Appointment" :options="$appointments" :selected="$item->appointment_id ?? $preselected" required />
<div class="row">
    <div class="col-md-8"><x-field name="name" label="Treatment / Procedure" :value="$item->name ?? ''" required /></div>
    <div class="col-md-4"><x-field name="cost" label="Cost (₱)" type="number" step="0.01" :value="$item->cost ?? ''" required /></div>
</div>
<x-field name="notes" label="Notes" type="textarea" :value="$item->notes ?? ''" />
<button class="btn btn-success"><i class="bi bi-save"></i> Save</button>
<a href="{{ route('treatments.index') }}" class="btn btn-secondary">Cancel</a>
