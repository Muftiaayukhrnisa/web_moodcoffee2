@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<div class="min-h-screen bg-amber-50 py-10">
    <div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center mb-8">
            <div class="w-32 h-32 bg-amber-200 rounded-full flex items-center justify-center shadow-md border-4 border-white">
                <i class="fas fa-user-circle text-7xl text-amber-700"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mt-4">My Profile</h1>
            <p class="text-gray-500">Kelola informasi akun Anda</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-amber-100">
            <div class="p-6 md:p-8">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-1 gap-5">
                        <div>
                            <label class="block text-gray-700 font-medium mb-2 flex items-center gap-2">
                                <i class="fas fa-user text-amber-600"></i> Nama
                            </label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2 flex items-center gap-2">
                                <i class="fas fa-envelope text-amber-600"></i> Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2 flex items-center gap-2">
                                <i class="fas fa-phone-alt text-amber-600"></i> Telepon
                            </label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" 
                                   class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-2 flex items-center gap-2">
                                <i class="fas fa-map-marker-alt text-amber-600"></i> Alamat
                            </label>
                            <textarea name="address" rows="3" 
                                      class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition">{{ old('address', $user->address) }}</textarea>
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="w-full bg-amber-700 hover:bg-amber-800 text-white font-semibold py-3 rounded-xl transition shadow-md flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
            <div class="bg-gray-50 px-6 py-4 border-t border-amber-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-white border border-red-300 text-red-600 hover:bg-red-50 hover:border-red-400 font-semibold py-2 rounded-xl transition flex items-center justify-center gap-2">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection