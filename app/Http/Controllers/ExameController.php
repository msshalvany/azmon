<?php

namespace App\Http\Controllers;

use App\Models\question;
use App\Models\std_exame;
use Carbon\Carbon;
use App\Models\exame;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Psy\Util\Str;

class ExameController extends Controller
{
    public function create_exame(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'count' => 'required',
            'name' => 'required',
            'rand_choice' => 'required',
            'rand_que' => 'required',
            'date' => 'required',
            'time' => 'required',
            'deadline' => 'required',
            'type' => 'required',
        ], [
            'user_id.required' => 'فیلد شناسه کاربر الزامی است.',
            'title.required' => 'فیلد عنوان الزامی است.',
            'count.required' => 'فیلد تعداد الزامی است.',
            'name.required' => 'فیلد نام الزامی است.',
            'rand_choice.required' => 'فیلد انتخاب رندوم الزامی است.',
            'rand_que.required' => 'فیلد سوال رندوم الزامی است.',
            'date.required' => 'فیلد تاریخ الزامی است.',
            'deadline.required' => 'فیلد مهلت الزامی است.',
            'type.required' => 'فیلد مهلت الزامی است.',
        ]);
        $date = Carbon::createFromFormat('Y/m/d', $request->date)->toDateString();
        $yourModel = new exame();
        $yourModel->user_id = session()->get('user');
        $yourModel->title = $validatedData['title'];
        $yourModel->count = $validatedData['count'];
        $yourModel->name = $validatedData['name'];
        $yourModel->rand_choice = $validatedData['rand_choice'];
        $yourModel->time = $validatedData['time'];
        $yourModel->rand_que = $validatedData['rand_que'];
        $yourModel->date = $date;
        $yourModel->deadline = $validatedData['deadline'];
        $yourModel->type = $validatedData['type'];
        $yourModel->exam_code = \Illuminate\Support\Str::random(20);

        $yourModel->save();

        // اقدامات دیگر در صورت نیاز...

        return redirect()->route('exame-list');
    }

    public function del_exame($id)
    {
        exame::find($id)->delete();
        return redirect()->back();

    }

    public function exame_edit_v($id)
    {
        $exmae = exame::find($id);
        return view('edit_exame', ['exmae' => $exmae]);

    }

    public function edit_exame(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'count' => 'required',
            'name' => 'required',
            'rand_choice' => 'required',
            'rand_que' => 'required',
            'date' => 'required',
            'time' => 'required',
            'deadline' => 'required',
            'type' => 'required',
        ], [
            'user_id.required' => 'فیلد شناسه کاربر الزامی است.',
            'title.required' => 'فیلد عنوان الزامی است.',
            'count.required' => 'فیلد تعداد الزامی است.',
            'name.required' => 'فیلد نام الزامی است.',
            'rand_choice.required' => 'فیلد انتخاب رندوم الزامی است.',
            'rand_que.required' => 'فیلد سوال رندوم الزامی است.',
            'date.required' => 'فیلد تاریخ الزامی است.',
            'deadline.required' => 'فیلد مهلت الزامی است.',
            'type.required' => 'فیلد مهلت الزامی است.',
        ]);
        $yourModel = exame::findOrFail($id);
        $yourModel->title = $validatedData['title'];
        $yourModel->count = $validatedData['count'];
        $yourModel->name = $validatedData['name'];
        $yourModel->rand_choice = $validatedData['rand_choice'];
        $yourModel->time = $validatedData['time'];
        $yourModel->rand_que = $validatedData['rand_que'];
        $yourModel->date = $validatedData['date'];
        $yourModel->deadline = $validatedData['deadline'];
        $yourModel->type = $validatedData['type'];
        $yourModel->save();

        // اقدامات دیگر در صورت نیاز...
        return redirect()->route('exame-list');
    }

    public function enter_exam($id)
    {
        if (session()->has('std_code')) {
            $exam = exame::find($id);
            return view('enter_exam', ['exam' => $exam]);
        } else {
            return redirect('/');
        }
    }

    public function login_exam(Request $request)
    {
        $exam = exame::where('exam_code', $request->exam_code)->get();
        if (count($exam) == 0) {
            return redirect()->back()->with('exam_login_err', 1);
        } else {
            $exam = exame::where('exam_code', $request->exam_code)->first();
            session()->put('std_code', $request->std_code);
            return view('enter_exam', ['exam' => $exam]);
        }

    }

    public function exam($id)
    {
        $exam = exame::find($id);
        $std_code = session('std_code');
        if (count(std_exame::where('std_code', $std_code)->where('exame_id', $id)->get()) == 0) {
            $que_all = question::where('exame_id', $exam->id)->get();
            $que_count = $exam->count;
            // ===========بخش سوتلا تصادفی ==================
            if ($exam->rand_que == 1 && $que_count < count($que_all)) {
                $que_all_array = $que_all->toArray();
                $selectedKeys = array_rand($que_all_array, $que_count);
                $selectedQuestions = array();
                foreach ($selectedKeys as $key) {
                    $selectedQuestions[] = $que_all_array[$key];
                }
                // ===========بخش سوتلا تصادفی ==================

            } else {
                $que_all_array = $que_all->toArray();
                $selectedQuestions = array();
                for ($i = 0; $i < min($exam->count, count($que_all_array)); $i++) {
                    $selectedQuestions[] = $que_all_array[$i];
                }
            }
            $std_exame = new std_exame();
            $std_exame->exame_id = $id;
            $std_exame->std_code = $std_code;
            $std_exame->ques = json_encode($selectedQuestions);
            $std_exame->save();
            $selectedQuestions = std_exame::where('std_code', $std_code)->where('exame_id', $id)->first()->ques;
            return \view('exam', ['exam' => $exam, 'ques' => json_decode($selectedQuestions)]);
        } else {
            $selectedQuestions = std_exame::where('std_code', $std_code)->where('exame_id', $id)->first()->ques;
            return \view('exam', ['exam' => $exam, 'ques' => json_decode($selectedQuestions)]);
        }
    }


    public function send_answer(Request $request)
    {
        $exam = exame::find($request->exame_id);
        $std_code = session('std_code');
        $std = std_exame::where('std_code', $std_code)->where('exame_id', $exam->id)->first();
        $que = json_decode($std->ques);
        foreach ($que as $item) {
            if ($item->id == $request->que_id) {
                $item->std_answer = $request->answer;
                break;
            }
        }
        std_exame::where('std_code', $std_code)->where('exame_id', $exam->id)->update([
            'ques' => json_encode($que)
        ]);
        return 1;
    }

    public function result_exame($id)
    {
        $exame = exame::find($id);
        $stds = std_exame::where('exame_id', $id)->get();
        if ($exame->presses != 1) {
            foreach ($stds as $item) {
                $std_ques = json_decode($item->ques);
                $score = 0;
                foreach ($std_ques as $item2) {
                    if (property_exists($item2, 'std_answer')) {
                        if ($item2->answer == $item2->std_answer) {
                            $score++;
                        }
                    }
                }
                std_exame::find($item->id)->update([
                    'score' => $score
                ]);
                $exame->update([
                    'presses' => 1
                ]);
            }
        }
        return \view('std_list', ['std' => $stds, 'exame' => $exame]);
    }
}
