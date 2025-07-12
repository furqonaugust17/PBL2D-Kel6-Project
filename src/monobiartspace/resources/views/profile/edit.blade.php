<x-app-layout>
    <x-slot:title>Profile</x-slot:title>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @include('profile.partials.update-profile-information-form')

                    @include('profile.partials.update-password-form')

                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
