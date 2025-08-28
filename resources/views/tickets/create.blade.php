@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">{{ __('tickets.title') }}</h2>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        <div class="mb-4">
<<<<<<< HEAD
            <label class="block font-medium">Requestor (Name | Department | Location)</label>
            <select id="requestor_picker" class="w-full border p-2 rounded" required>
                <option value="">-- Select --</option>
                <option data-name="Jane Wanjiku" data-dept="Finance" data-location="First floor">Jane Wanjiku | Finance | First floor</option>
                <option data-name="David Ochieng" data-dept="HR" data-location="Fourth floor">David Ochieng | HR | Fourth floor</option>
                <option data-name="Amina Hassan" data-dept="HR" data-location="Second floor">Amina Hassan | HR | Second floor</option>
                <option data-name="Kevin Kipchumba" data-dept="HR" data-location="Third floor">Kevin Kipchumba | HR | Third floor</option>
                <option data-name="Rose Atieno" data-dept="ICT" data-location="Ground floor">Rose Atieno | ICT | Ground floor</option>
            </select>
            
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sel = document.getElementById('requestor_picker');
                const nameEl = document.getElementById('requestor_name');
                const deptEl = document.getElementById('department');
                const locEl = document.getElementById('location');
                function updateHidden() {
                    const opt = sel.options[sel.selectedIndex];
                    nameEl.value = opt.getAttribute('data-name') || '';
                    deptEl.value = opt.getAttribute('data-dept') || '';
                    locEl.value = opt.getAttribute('data-location') || '';
                }
                sel.addEventListener('change', updateHidden);
            });
            </script>
=======
            <label for="requestor_name" class="block font-medium">{{ __('Requestor Name') }}</label>
            <input type="text" name="requestor_name" id="requestor_name" class="w-full border p-2 rounded" required placeholder="Enter your full name">
        </div>
        <div class="mb-4">
            <label for="department" class="block font-medium">{{ __('Department') }}</label>
            <input type="text" name="department" id="department" class="w-full border p-2 rounded" required placeholder="Enter your department">
>>>>>>> 68af52fa054b2312466ce70c28bc354680ce7bd4
        </div>

        <div class="mb-4">
            <label for="category" class="block font-medium">Category</label>
            <select name="category" id="category" class="w-full border p-2 rounded" required>
                <option value="">-- Select --</option>
                <option value="Software">Software</option>
                <option value="Hardware">Hardware</option>
                <option value="Networking">Networking</option>
                <option value="SpecialUse">Special use software</option>
                <option value="GeneralSupport">General Support</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="email" class="block font-medium">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" class="w-full border p-2 rounded" required placeholder="Enter your email address">
        </div>
        <div class="mb-4">
            <label for="issue" class="block font-medium">{{ __('Issue Description') }}</label>
            <textarea name="issue" id="issue" class="w-full border p-2 rounded" rows="4" required placeholder="Describe the issue in detail"></textarea>
        </div>
        <div class="mb-4">
            <label for="remarks" class="block font-medium">{{ __('Remarks (Optional)') }}</label>
            <textarea name="remarks" id="remarks" class="w-full border p-2 rounded" rows="2" placeholder="Any additional information (optional)"></textarea>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ __('tickets.submit') }}
            </button>
        </div>
    </form>
</div>
@endsection
