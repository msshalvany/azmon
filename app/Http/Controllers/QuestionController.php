<?php

namespace App\Http\Controllers;

use App\Imports\QuestionsImport;
use App\Models\question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
class QuestionController extends Controller
{
    public function create_que(Request $request, $id)
    {
//        return $request;
        // اعتبارسنجی داده‌های دریافتی از درخواست
        $validatedData = $request->validate([
            'text' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'level' => 'nullable',
            'fasl' => 'nullable',
            'chose1' => 'nullable',
            'chose2' => 'nullable',
            'chose3' => 'nullable',
            'chose4' => 'nullable',
            'chose1imgِ' => 'nullable',
            'chose2img' => 'nullable',
            'chose3img' => 'nullable',
            'chose4img' => 'nullable',
            'answer' => 'nullable',
        ]);
        // ایجاد سوال جدید
        $question = new question();
        $question->type = 'des';
        $question->exame_id = $id;
        $question->level =  $validatedData['level'];
        $question->fasl = $validatedData['fasl'];
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
        if ($request->hasFile('chose1img')) {
            $image = $request->file('chose1img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $id . '/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $question->chose1img = $imagePath;
        }
        if ($request->hasFile('chose2img')) {
            $image = $request->file('chose2img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $id . '/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $question->chose2img = $imagePath;
        }
        if ($request->hasFile('chose3img')) {
            $image = $request->file('chose3img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $id . '/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $question->chose3img = $imagePath;
        }
        if ($request->hasFile('chose4img')) {
            $image = $request->file('chose4img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $id . '/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));
            $question->chose4img = $imagePath;
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
            'chose1imgِ' => 'nullable',
            'chose2img' => 'nullable',
            'chose3img' => 'nullable',
            'chose4img' => 'nullable',
            'answer' => 'nullable',
            'fasl' => 'nullable',
            'level' => 'nullable',
        ]);

        // بررسی وجود فیلد answer در فر
        $question->fasl = $validatedData['fasl'];
        $question->level = $validatedData['level'];
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
    public function importExel(Request $request)
    {
        $request->validate([
            'exame_id' => 'required|integer',
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('exel', $filename, 'public');

        $fullPath = Storage::disk('public')->path($path);

        if (Storage::disk('public')->exists($path)) {
            Excel::import(new QuestionsImport($request->exame_id), $fullPath);
            return back()->with('success', 'سوالات با موفقیت وارد شدند.');
        } else {
            return back()->with('error', 'خطا در ذخیره‌سازی فایل. لطفاً مجدداً تلاش کنید.');
        }


    }
}
