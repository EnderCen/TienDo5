
use App\Models\User;
use Illuminate\Support\Facades\Hash;

public function register(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users|max:100',
        'phone' => 'nullable|string|max:20',
        'password' => 'required|string|min:6|confirmed',
        'username' => 'required|string|unique:users|max:50',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'password' => Hash::make($validated['password']),
        'username' => $validated['username'],
        'avatar' => $request->file('avatar') ? $request->file('avatar')->store('avatars', 'public') : null,
    ]);

    auth()->login($user);

    return redirect('/')->with('success', 'Đăng ký thành công!');
}