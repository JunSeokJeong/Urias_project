<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Session;

date_default_timezone_set('Asia/Seoul');

// 실시간 영상통화 컨트롤러
class VideoCallController extends Controller{
    
    // 실시간 영상통화 서비스 메인페이지로 이동
    public function videoCallIndex() {
        return view('blindcare.videoCallIndex');
    } // end fRIndex
    
    // 내가 등록한 봉사시간 리스트로 이동
    public function volunteerTimeList($year, $month) {
        //로그인 확인
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 필요한 서비스입니다.');
            </script>";
            
            return redirect()->route('index');
        }
        
        /**
         * 캘린더 구성
        */
        $calendar['year']   = (int)$year;
        $calendar['month']  = (int)$month;
        
        // 넘어오는 월의 값이 1보다 작거나 12보다 클 때 년도 변화
        if($calendar['month'] < 1) {
            $calendar['year']--;
            $calendar['month'] = 12;
        }
        else if($calendar['month'] > 12) {
            $calendar['year']++;
            $calendar['month'] = 1;
        }
        
        $calendar['month'] = $calendar['month'] < 10 ? '0'.$calendar['month'] : $calendar['month'];
        
        $calendar['doms']   = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
        
        $mktime     = mktime(0, 0, 0, $calendar['month'], 1, $calendar['year']);        // 입력된 값으로 년-월-01을 만든다
        $calendar['days']       = date("t", $mktime);                       // 현재의 year와 calendar['month']로 현재 달의 일수 구해오기
        $calendar['startDay']   = date("w", $mktime);                       // 시작요일 알아내기
        
        $calendar['startDay'] = strtotime($calendar['year'].'-'.$calendar['month'].'-01');
        list($calendar['tday'], $calendar['sweek']) = explode('-', date('t-w', $calendar['startDay']));  // 총 일수, 시작요일
        $calendar['tweek'] = ceil(($calendar['tday'] + $calendar['sweek']) / 7);  // 총 주차
        $calendar['lweek'] = date('w', strtotime($calendar['year'].'-'.$calendar['month'].'-'.$calendar['tday']));  // 마지막요일

        $t_y_m = $calendar['year'].'-'.$calendar['month'].'-%';

        /**
         * 봉사시간 불러오기
        */
        $tmonth_list = array();
        $count = 0;
        
        $result = DB::table('volunteer_action_times')->where('action_day', 'LIKE', $t_y_m)->get();
        foreach ($result as $days) {
            $tmonth_list[$count] = array();
            $tmonth_list[$count]['num'] = $days->num;
            $tmonth_list[$count]['writer'] = $days->writer;
            $tmonth_list[$count]['action_day'] = $days->action_day;
            $tmonth_list[$count]['action_start_time'] = $days->action_start_time;
            $tmonth_list[$count]['action_end_time'] = $days->action_end_time;

            $count++;
        }

        return view('blindcare.volunteerTimeList', [
            'calendar' => $calendar,
            'tmonth_list' => $tmonth_list
        ]);
    } // end volunteerTimeList
    
    // 내가 등록한 봉사시간 리스트로 이동
    public function volunteerTimeCalendar() {
        //로그인 확인
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 필요한 서비스입니다.');
            </script>";
            
            return redirect()->route('index');
        }
        
        /**
         * 봉사시간 불러오기
        */
        $tmonth_list = array();
        $count = 0;
        
        $result = DB::table('volunteer_action_times')->get();
        foreach ($result as $days) {
            $tmonth_list[$count] = array();
            $tmonth_list[$count]['num'] = $days->num;
            $tmonth_list[$count]['writer'] = $days->writer;
            $tmonth_list[$count]['action_day'] = $days->action_day;
            $tmonth_list[$count]['action_start_time'] = $days->action_start_time;
            $tmonth_list[$count]['action_end_time'] = $days->action_end_time;

            $count++;
        }

        return view ('blindcare.volunteerTimeCalendar', [
            'tmonth_list' => $tmonth_list
        ]);
    } // end volunteerTimeList
    
    // 봉사시간 등록 후 봉사시간 리스트로 재이동
    public function volunteerTimeRegist(Request $request) {
        //로그인 확인
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 필요한 서비스입니다.');
            </script>";
            
            return redirect()->route('index');
        }
        
        // 설정값 받기
        $choose_day = $request->input('choose_day');        // 선택한 날짜
        $start_times = $request->input('start_times');      // 봉사가능한 시작 시간
        $start_minutes = $request->input('start_minutes');  // 봉사가능한 시작 분
        $end_times = $request->input('end_times');          // 봉사가능한 종료 시간
        $end_minutes = $request->input('end_minutes');      // 봉사가능한 종료 분
        
        // 선택값 시간문자열형태로 변환
        $start_time = $start_times.':'.$start_minutes.':00';
        $end_time = $end_times.':'.$end_minutes.':00';
        
        // 봉사가능한 시간 테이블에 등록
        $result = DB::table('volunteer_action_times')->insert([
            'writer'            => Auth::user()->email,
            'action_day'        => $choose_day,
            'action_start_time' => $start_time,
            'action_end_time'   => $end_time
        ]);
        
        echo "<script>
            window.alert('봉사가능한 시간 등록에 성공하셨습니다.');
        </script>";

        $tyear = date('Y');
        $tmonth = date('m');
    
        return redirect("/blindcare/volunteerTimeList/$tyear/$tmonth");
    } // end volunteerTimeRegist
    
    // 질문 게시판 리스트로 이동(봉사자)
    public function questionList() {
        $question_list = array();
        $count = 0;
        
        $result = DB::table('blind_questions')->get();
        
        foreach($result as $question) {
            $question_list[$count] = array();
            $question_list[$count]['list_num']      = $count + 1;
            $question_list[$count]['num']           = $question->num;
            $question_list[$count]['writer']        = $question->writer;
            $question_list[$count]['write_date']    = $question->write_date;
            
            $count++;
        }
        
        return view('blindcare.questionList', [
            'question_list' => $question_list
        ]);
    } // end questionList
    
    // 질문 게시판 뷰로 이동(봉사자)
    public function questionView($num) {
        $result = DB::table('blind_questions')->where('num', '=', (int)$num)->get();
        
        foreach($result as $question) {
            $question_view = array();
            $question_view['num']           = $question->num;
            $question_view['writer']        = $question->writer;
            $question_view['question_file'] = $question->question_file;
            $question_view['capture_file']  = $question->capture_file;
            $question_view['write_date']    = $question->write_date;
        }
        
        $question_comment = array();
        $count = 0;
        
        $result = DB::table('volunteer_comments')->where('question_num', '=', (int)$num)->get();
        
        foreach($result as $question) {
            $question_comment[$count] = array();
            $question_comment[$count]['list_num']       = $count + 1;
            $question_comment[$count]['num']            = $question->num;
            $question_comment[$count]['question_num']   = $question->question_num;
            $question_comment[$count]['writer']         = $question->writer;
            $question_comment[$count]['comment']        = $question->comment;
            $question_comment[$count]['write_date']     = $question->write_date;
            
            $count++;
        }

        return view('blindcare.questionView', [
            'question_view'     => $question_view,
            'question_comment'  => $question_comment
        ]);
    } // end questionView
    
    // 현재 매칭가능한 봉사자 시간 목록
    public function volunteerTimePresent() {
        $today = date('Y-m-d');
        $totime = date('H:i:s');


        // 현재 날짜 및 시간대에 등록한 봉사자 목록
        $data = DB::table('volunteer_action_times')->where('action_day', '=', $today)
                                                    ->where('action_start_time', '<=', $totime)
                                                    ->where('action_end_time', '>=', $totime)
                                                    ->get();

        
        if($data) {
            $to_time_list = array();
            $count = 0;

            foreach($data as $time) {
                $to_time_list[$count] = array();
                $to_time_list[$count]['list_num'] = $count + 1;
                $to_time_list[$count]['num'] = $time->num;
                $to_time_list[$count]['writer'] = $time->writer;
                $to_time_list[$count]['action_day'] = $time->action_day;
                $to_time_list[$count]['action_start_time'] = $time->action_start_time;
                $to_time_list[$count]['action_end_time'] = $time->action_end_time;
                
                $count++;
            }
        }
               
        return view('blindcare.volunteerTimeList', [
            'to_time_list'     => $to_time_list
        ]);
    }
    
    // 내 질문 리스트 및 봉사자의 답변(시각장애인)
    public function questionListComment() {
        $question_list = array();
        $comment_list = array();
        $count = 0;
        
        $result = DB::table('blind_questions')->where('writer', '=', Auth::user()->email)->get();
        
        foreach($result as $question) {
            $question_list[$count] = array();
            $question_list[$count]['list_num']      = $count + 1;
            $question_list[$count]['num']           = $question->num;
            $question_list[$count]['writer']        = $question->writer;
            $question_list[$count]['write_date']    = $question->write_date;
            
            $comment_list[$count] = array();
            $count2 = 0;
            
            $result2 = DB::table('volunteer_comments')->where('question_num', '=', $question_list[$count]['num'])->get();
            
            foreach($result2 as $comment) {
                $comment_list[$count][$count2] = array();
                $comment_list[$count][$count2]['list_num']      = $count2 + 1;
                $comment_list[$count][$count2]['num']           = $comment->num;
                $comment_list[$count][$count2]['question_num']  = $comment->question_num;
                $comment_list[$count][$count2]['writer']        = $comment->writer;
                $comment_list[$count][$count2]['comment']       = $comment->comment;
                $comment_list[$count][$count2]['write_date']    = $comment->write_date;
                
                $count2++;
            }
            
            $count++;
        }
        
        return view('blindcare.questionListComment', [
            'question_list'     => $question_list,
            'comment_list'      => $comment_list
        ]);
    }
    
    // 시각장애인 질문에 대한 봉사자의 댓글 작성 후 질문게시판 뷰로 재이동
    public function questionCommentRegist(Request $request) {
        //로그인 확인
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 필요한 서비스입니다.');
            </script>";
            
            return redirect()->route('index');
        }
        
        // 설정값 받기
        $question_num = $request->input('question_num');        // 질문 번호
        $comment = $request->input('comment');      // 봉사가능한 시작 시간
        
        // 봉사자 답변 테이블에 등록
        $result = DB::table('volunteer_comments')->insert([
            'question_num'      => $question_num,
            'writer'            => Auth::user()->email,
            'comment'           => $comment,
            'write_date'        => date('Y-m-d h:i:s')
        ]);
        
        echo "<script>
            window.alert('질문에 대한 답변 등록에 성공하셨습니다.');
        </script>";

        return redirect("/blindcare/questionView/$question_num");
    }
    
    // 현재 매칭가능한 봉사자 시간 목록 로드(앱, 시각장애인)
    public function volunteerTimePresentApp() {
        $result = array();
        $callback = $_GET['callback'];
        $result_data = 'failed';
        
        $today = date('Y-m-d');
        $totime = date('H:i:s');

        

        // 현재 날짜 및 시간대에 등록한 봉사자 목록
        $data = DB::table('volunteer_action_times')->where('action_day', '=', $today)
                                                    ->where('action_start_time', '<=', $totime)
                                                    ->where('action_end_time', '>=', $totime)
                                                    ->get();
        
        if($data != null) {
            $result_data = 'success';
            
            $to_time_list = array();
            $count = 0;
            
            foreach($data as $time) {
                $to_time_list[$count] = array();
                $to_time_list[$count]['list_num'] = $count + 1;
                $to_time_list[$count]['num'] = $time->num;
                $to_time_list[$count]['writer'] = $time->writer;
                $to_time_list[$count]['action_day'] = $time->action_day;
                $to_time_list[$count]['action_start_time'] = $time->action_start_time;
                $to_time_list[$count]['action_end_time'] = $time->action_end_time;
                
                $count++;
            }
        }
        
        $result = array(
            'result' => $result_data,
            'to_time_list' => $to_time_list
        );
        
        echo $callback."(".json_encode($result).")";
    }
    
    // 앱에서 질문녹음파일, 캡쳐파일을 등록 후 질문글 저장(앱, 시각장애인)
    public function questionRegist() {
        $result = array();
        $callback = $_GET['callback'];
        $email = $_GET['user'];
        $question_file = $_GET['question_file'];
        $capture_file = $_GET['capture_file'];
        $result_data = 'failed';
        
        $data = DB::table('blind_questions')->insert([
            'writer'            => $email,
            'question_file'     => $question_file,
            'capture_file'      => $capture_file,
            'write_date'        => date('Y-m-d h:i:s')
        ]);
        
        if($data) {
            $result_data = 'success';
        }
        
        $result = array(
            'result' => $result_data
        );
        
        echo $callback."(".json_encode($result).")";
        
    } // end questionRegist
    
    // 내 질문에 대한 답변 리스트 화면으로 이동(앱, 시각장애인)
    public function myQuestionCommentApp() {
        $result = array();
        $callback = $_GET['callback'];
        $user_email = $_GET['user'];
        $result_data = 'failed';
        
        $question_list = array();
        $comment_list = array();
        $count = 0;
        
        $data = DB::table('blind_questions')
            ->where('writer', '=', $user_email)
            ->get();
        
        if($data != null) {
            $result_data = 'success';
            
            foreach($data as $question) {
                $question_list[$count] = array();
                $question_list[$count]['list_num']      = $count + 1;
                $question_list[$count]['num']           = $question->num;
                $question_list[$count]['writer']        = $question->writer;
                $question_list[$count]['write_date']    = $question->write_date;
                
                $comment_list[$count] = array();
                $count2 = 0;
                
                $data2 = DB::table('volunteer_comments')->where('question_num', '=', $question_list[$count]['num'])->get();
                
                foreach($data2 as $comment) {
                    $comment_list[$count][$count2] = array();
                    $comment_list[$count][$count2]['list_num']      = $count2 + 1;
                    $comment_list[$count][$count2]['num']           = $comment->num;
                    $comment_list[$count][$count2]['question_num']  = $comment->question_num;
                    $comment_list[$count][$count2]['writer']        = $comment->writer;
                    $comment_list[$count][$count2]['comment']       = $comment->comment;
                    $comment_list[$count][$count2]['write_date']    = $comment->write_date;
                    
                    $count2++;
                }
                
                $count++;
            }
        }
        
        $result = array(
            'result'            => $result_data,
            'question_list'     => $question_list,
            'comment_list'      => $comment_list
        );
        
        echo $callback."(".json_encode($result).")";
    }
    
    // 시각장애인이 등록한 질문 리스트 화면으로 이동(앱, 봉사자)
    public function questionListApp() {
        $result = array();
        $callback = $_GET['callback'];
        $result_data = 'failed';
        
        $count = 0;
        $question_list = array();
        
        $data = DB::table('blind_questions')->get();
        
        if($data) {
            $result_data = 'success';
            
            foreach($data as $question) {
                $question_list[$count] = array();
                $question_list[$count]['list_num']      = $count + 1;
                $question_list[$count]['num']           = $question->num;
                $question_list[$count]['writer']        = $question->writer;
                $question_list[$count]['question_file'] = $question->question_file;
                $question_list[$count]['capture_file']  = $question->capture_file;
                $question_list[$count]['write_date']    = $question->write_date;
                $question_list[$count]['comment_count'] = DB::table('volunteer_comments')->where('question_num', '=', $question_list[$count]['num'])->count();
                
                $count++;
            }
        }
        
        $result = array(
            'result'            => $result_data,
            'question_list'     => $question_list
        );
        
        echo $callback."(".json_encode($result).")";
    }
    
    // 시각장애인이 등록한 질문 뷰 화면 로드(앱, 봉사자)
    public function questionViewApp() {
        $result = array();
        $callback = $_GET['callback'];
        $choose_num = $_GET['choose_num'];
        $result_data = 'failed';
        
        $count = 0;
        $comment_list = array();
        
        $data = DB::table('volunteer_comments')->where('question_num', '=', $choose_num)->get();
        
        if($data != null) {
            $result_data = 'success';
            
            foreach($data as $comment) {
                $comment_list[$count]['list_num']       = $count + 1;
                $comment_list[$count]['num']            = $comment->num;
                $comment_list[$count]['writer']         = $comment->writer;
                $comment_list[$count]['comment']        = $comment->comment;
                $comment_list[$count]['write_date']     = $comment->write_date;
                
                $count++;
            }
        }
        
        $result = array(
            'result'            => $result_data,
            'comment_list'      => $comment_list
        );
        
        echo $callback."(".json_encode($result).")";
    }
    
    // 시각장애인의 질문에 대한 봉사자 답변 등록(앱, 봉사자)
    public function questionCommentRegistApp() {
        $result = array();
        $callback = $_GET['callback'];
        $choose_num = $_GET['choose_num'];
        $user_email = $_GET['user'];
        $comment = $_GET['comment'];
        $result_data = 'failed';
        
        // 봉사자 답변 테이블에 등록
        $data = DB::table('volunteer_comments')->insert([
            'question_num'      => $choose_num,
            'writer'            => $user_email,
            'comment'           => $comment,
            'write_date'        => date('Y-m-d h:i:s')
        ]);
        
        if($data) {
            $result_data = 'success';
        }
        
        $result = array(
            'result'            => $result_data
        );
        
        echo $callback."(".json_encode($result).")";
    }
    
    // 내가 등록한 봉사시간 리스트로 이동
    public function volunteerTimeListApp() {
        $result = array();
        $callback = $_GET['callback'];
        $result_data = 'failed';
        
        if(isset($_GET['days'])) {
            $day = $_GET['days'];
            
            $data = DB::table('volunteer_action_times')->where('action_day', '=', $day)->get();
        }
        else {
            $data = DB::table('volunteer_action_times')->get();
        }
        
        if($data != null) {
            $result_data = 'success';
            $count = 0;
            $time_list = array();
            
            foreach($data as $days) {
                $time_list[$count] = array();
                $time_list[$count]['num'] = $days->num;
                $time_list[$count]['writer'] = $days->writer;
                $time_list[$count]['action_day'] = $days->action_day;
                $time_list[$count]['action_start_time'] = $days->action_start_time;
                $time_list[$count]['action_end_time'] = $days->action_end_time;
    
                $count++;
            }
        }
        
        $result = array(
            'result'    => $result_data,
            'time_list' => $time_list
        );
        
        echo $callback."(".json_encode($result).")";
    }
    
    // 봉사시간 등록 후 봉사시간 리스트로 재이동(앱, 봉사자)
    public function volunteerTimeRegistApp() {
        $result = array();
        $callback = $_GET['callback'];
        $result_data = 'failed';
        
        $user_email = $_GET['user'];
        $day = $_GET['days'];
        $times = $_GET['times'];
        
        
        $start_time = $times['start_times'].":".$times['start_minutes'].":00";
        $end_time = $times['end_times'].":".$times['end_minutes'].":00";
        
        $data = DB::table('volunteer_action_times')->insert([
            'writer'            => $user_email,
            'action_day'        => $day,
            'action_start_time' => $start_time,
            'action_end_time' => $end_time
        ]);
        
        if($data) {
            $result_data = 'success';
        }
        
        $result = array(
            'result' => $result_data
        );
        
        echo $callback."(".json_encode($result).")";
    }
    
    // 웹rtc에 필요한 id값 저장(앱, 봉사자)
    public function idRegistApp() {
        $result = array();
        $callback = $_GET['callback'];
        $result_data = 'failed';
        
        $email = $_GET['user_email'];
        $id = $_GET['user_id'];
        
        $data = DB::table('rtc_ids')
            ->where('email', '=', $email)
            ->delete();
        
        $data = DB::table('rtc_ids')->insert([
            'email'     => $email,
            'id'        => $id
        ]);
    
        if($data) {
            $result_data = 'success';
        }
        
        $result = array(
            'result' => $result_data
        );
        
        echo $callback."(".json_encode($result).")";
    }
    
    // 웹rtc에 필요한 id값 저장(웹, 봉사자)
    public function idRegist($id) {
        $data = DB::table('rtc_ids')
            ->where('email', '=', Auth::user()->email)
            ->delete();
            
        $data = DB::table('rtc_ids')->insert([
            'email'     => Auth::user()->email,
            'id'        => $id
        ]);
        
        return redirect("/blindcare/blindIndex");
    }
    
    
    
    // 웹rtc에 필요한 id값 로드
    public function idLoadApp() {
        $result = array();
        $callback = $_GET['callback'];
        
        $email = $_GET['user'];
        
        $result_data = 'failed';
        
        $data = DB::table('rtc_ids')
            ->where('email', '=', $email)
            ->get();
        
        if($data != null) {
            $result_data = 'success';
            
            $rtc = array();
            
            foreach($data as $info) {
                $rtc['email'] = $info->email;    
                $rtc['id'] = $info->id;
            }
        }
        
        $result = array(
            'result' => $result_data,
            'rtc' => $rtc
        );
        
        echo $callback."(".json_encode($result).")";
    }
    
    public function rtcReady() {
        return view('blindcare.rtcReady');
    }
    
    public function rtcChat() {
        return view('blindcare.rtcChat');
    }
}

?>

