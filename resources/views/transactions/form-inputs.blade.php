@php $editing = isset($transaction) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $transaction->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="amount"
            label="Amount"
            :value="old('amount', ($editing ? $transaction->amount : ''))"
            max="255"
            step="0.01"
            placeholder="Amount"
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $transaction->status : 'Pending')) @endphp
            <option value="Pending" {{ $selected == 'Pending' ? 'selected' : '' }} >Pending</option>
            <option value="Successful" {{ $selected == 'Successful' ? 'selected' : '' }} >Successful</option>
            <option value="Failed" {{ $selected == 'Failed' ? 'selected' : '' }} >Failed</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
