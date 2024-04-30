<?php

namespace App\Http\Controllers;

use App\Models\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
    public function create_que(Request $request, $id)
    {
//        return $request;
        // اعتبارسنجی داده‌های دریافتی از درخواست
        $validatedData = $request->validate([
            'text' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'chose1' => 'nullable',
            'chose2' => 'nullable',
            'chose3' => 'nullable',
            'chose4' => 'nullable',
            'answer' => 'nullable',
        ]);
        // ایجاد سوال جدید
        $question = new question();
        $question->type = 'des';
        $question->exame_id = $id;
        $question->text = $validatedData['text'];
        if ($request->has('answer')) {
            $question->type = 'test';
            $question->chose1 = $validatedData['chose1'];
            $question->chose2 = $validatedData['chose2'];
            $question->chose3 = $validatedData['chose3'];
            $question->chose4 = $validatedData['chose4'];
            $question->answer = $validatedData['answer'];
        }
        // ذخیره عکس در پوشه مرتبط با آزمون
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $id . '/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $question->image = $imagePath;
        }

        $question->save();

        // پیام موفقیت
        return redirect()->route('que_list',['id'=>$id]);
    }
    public function que_edit_v($id)
    {
        $question =  question::find($id);
        return view('que_edit_v',['question'=>$question,'id'=>$id]);

    }
    public function del_que($id)
    {
        question::find($id)->delete();
        return  redirect()->back();

    }
    public function edit_que(Request $request , $id)
    {
        // بررسی وجود شناسه سوال
        $question = Question::find($id);
        // اعتبارسنجی داده‌های دریافتی از درخواست
        $validatedData = $request->validate([
            'text' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'chose1' => 'nullable',
            'chose2' => 'nullable',
            'chose3' => 'nullable',
            'chose4' => 'nullable',
            'answer' => 'nullable',
        ]);

        // بررسی وجود فیلد answer در فر

        // به‌روزرسانی مقادیر سوال
        $question->type = 'des';
        $question->text = $validatedData['text'];
        if ($request->has('answer')) {
            $question->type = 'test';
            $question->chose1 = $validatedData['chose1'];
            $question->chose2 = $validatedData['chose2'];
            $question->chose3 = $validatedData['chose3'];
            $question->chose4 = $validatedData['chose4'];
            $question->answer = $validatedData['answer'];
        }

        // ذخیره عکس در صورت بروزرسانی
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $question->exame_id . '/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $question->image = $imagePath;
        }

        $question->save();

        // پیام موفقیت
        return redirect()->route('que_list',['id'=>$question->exame_id]);
    }
}
