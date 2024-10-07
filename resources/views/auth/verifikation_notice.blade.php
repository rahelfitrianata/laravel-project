<form action="{{ route('verify.code') }}" method="POST">
    @csrf
    <input type="text" name="code" placeholder="Enter verification code" required>
    <button type="submit">Verify</button>
</form>
