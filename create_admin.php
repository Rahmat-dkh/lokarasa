<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$u = \App\Models\User::firstOrNew(['email' => 'rahmathdyt@gmail.com']);
$u->name = 'Rahmat Hidayat';
$u->password = bcrypt('rahmattt');
$u->role = 'admin';
$u->save();

echo "User {$u->email} is now Admin with ID {$u->id}\n";
