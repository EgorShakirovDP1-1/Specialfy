<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{




    public function profile($id) {
        $user = User::find($id);



        $likedPostIds = Like::where('user_id', $user->id)
                   ->pluck('post_id')
                   ->toArray();

        if(!empty($likedPostIds)){
            foreach ($likedPostIds as $postId) {
                $likedPosts[] = Post::find($postId);
            }
    
            foreach ($likedPosts as $likedPost) {
                $likedPost->postImage1 = asset($likedPost->postImage1);
                $likedPost->likesCount = $likedPost->likes->count();
            
                if(auth()->user()){
                    $likedPost->isLikedByUser = $likedPost->likes()->where('user_id', auth()->id())->exists();
                }
            }
        }

        $user['avatar'] = $user->getImageURL();

        return Inertia::render("User/Profile", [
            'user' => $user,
           
            'likedPosts' => $likedPosts ?? null,
        ]);
    }

    public function edit($id) {
        $user = User::find($id);
        $user['avatar'] = asset('storage/' . $user->avatar);

        return Inertia::render("User/Edit")->with('user', $user);
    }

    public function update(UserUpdateRequest $request) {
        $id = auth()->user()->id;
        $user = User::find($id);

        $validatedData = $request->validated();

        if (isset($validatedData['avatar'])) {
            $avatarPath = request()->file('avatar')->store('profile', 'public');
            $validatedData['avatar'] = $avatarPath;
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
        }

        if (isset($validatedData['password']) && Hash::check(request()->old_password, $user->password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
            auth()->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }

        $user->update($validatedData);

        return redirect()->route('home')->with('message', 'Profile updated successfully!');
    }
    public function makeAdmin(User $user)
    {
        // Update the user's role to 'admin'
        $user->is_admin = '1';
        $user->save();

        return back()->with('success', 'User has been given admin rights.');
    }
    public function destroy($id) {
        $user = User::find($id);

        if ($user) {
            auth()->logout();
            $user->delete();

            return redirect()->route('home')->with('message', 'User deleted successfully!');
        }

        return redirect()->route('home')->with('message', 'User not found!');
    }
    public function destroyByAdmin($user_id)
{
    // Получаем текущего пользователя
    $currentUser = Auth::user();

    // Проверка, если пользователь пытается удалить сам себя
    if ($user_id === $currentUser->id) {
        return redirect()->route('home')->with('message', 'Вы не можете удалить свой собственный аккаунт!');
    }

    // Находим пользователя по ID
    $user = User::find($user_id);

    // Проверка, существует ли пользователь
    if (!$user) {
        return redirect()->route('home')->with('message', 'Пользователь не найден!');
    }

    // Удаляем пользователя, если все условия выполнены
    $user->delete();

    return redirect()->route('home')->with('message', 'Пользователь успешно удален!');
}
}
