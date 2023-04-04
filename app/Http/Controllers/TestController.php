<?php

namespace App\Http\Controllers;

// use

use App\Jobs\GetStudent;
use App\Models\Answer;
use App\Models\PPDB\JurusanStudent;
use App\Models\PPDB\User;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TestController extends Controller
{
    private function getFisikQuestions()
    {
        // return Question::whereRelation('type', 'name', 'Tes Buta Warna')->get();
        return Question::filter(['type' => 1])->get();
    }

    private function getWawancaraQuestions()
    {
        return Question::whereRelation('type', 'name', 'Tes Wawancara')->whereRelation('jurusan', 'slug', $this->getJurusanStudentSlug())->get();
    }

		private function getJurusanStudentSlug()
		{
			// $result = JurusanStudent::where('kode', request('student'))->first();
			$student = $this->getStudent(request('student'));
			return $student->identitas->jurusan->slug;
		}

    private function getStudent(?string $username = null)
    {
        if (is_null($username)) $username = request()->get('username');
        return User::where('username', $username)->first();
    }

    public function index(Request $req)
    {
        $test = $req->query('test');
        $resolver = 'get' . ucfirst($test) . 'Questions';
        $questions = $this->$resolver();

        return view("pages.dashboard.test.$test", [
            'questions' => $questions
        ]);
    }

    public function store(Request $req)
    {
        // try {
					// dd($req->all());

            $creden = $req->validate([
                'answer' => 'required|array',
								'answer.*' => 'required'
            ],
						[
							'answer.*.required' => 'The answer is required',
							'answer.required' => 'Please choose an answer'
						]);
            // dd($creden);

            $student = $this->getStudent($req->get('student'));
            // dd($student);

            foreach ($creden['answer'] as $id => $answer) {
                // dispatch(function () use ($id, $answer, $student) {
                    Answer::create([
                        'question_id' => $id,
                        'answer' => $answer,
                        'student_id' => $student->id
                    ]);
                // });
            }

            alert(['success' => 'Berhasil menyimpan jawaban.']);
            return redirect()->route('dashboard.loby.index', [
                'test' => $req->get('test'),
                'student' => $req->get('student'),
            ]);

        // } catch (\Throwable $th) {
            // alert(['danger' => 'Maaf, terjadi kesalahan saat menyimpan jawaban.']);
            // return redirect()->route('dashboard.test.index', [
            //     'test' => $req->get('test'),
            //     'student' => $req->get('student'),
            // ]);
        // }
    }
}
