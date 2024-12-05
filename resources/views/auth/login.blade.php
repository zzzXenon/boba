<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        
        <div>
            <button type="submit">Login</button>
        </div>
        
        @error('username')
            <div>{{ $message }}</div>
        @enderror
    </form>
</body>
</html>
