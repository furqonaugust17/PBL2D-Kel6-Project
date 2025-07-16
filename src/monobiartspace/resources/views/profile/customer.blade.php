<x-app>
    <x-slot:title>Profile</x-slot:title>
    <div class="page-title light-background">
        <div class="container">
            <h1>Profile</h1>
        </div>
    </div>
    <section class="section">
        <div class="container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @include('profile.partials.update-customer-profile')

            @include('profile.partials.update-password-form')

            @include('profile.partials.delete-user-form')
        </div>
    </section>
</x-app>
