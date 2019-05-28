<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Course;
use App\CoursePackage;
use Firebase\JWT\JWT;
use App\EssayPilihanGanda;


function getMinutes($value, $format)
{
    $val = (int)$value;
    $far = (string)$format;
    return Carbon\Carbon::createFromTime($val)->format($far);
}

function statusEncounter($flag) {
    $list_status = [
        '0' => 'Tidak Lulus',
        '1' => 'Belum tersedia',
        '2' => 'Ujian tersedia',
        '3' => 'Proses penilaian',
        '4' => 'Lulus',
        '5' => 'Mengulang'
    ];

    return $list_status[$flag];
}

function branch($id) {
    $branch = \App\Branch::find($id);

    return ($branch) ? $branch->name : '-';
}

function overallProgress($id, $types=null) {
    $answer = null;
    $encounterAssessments = [];
    $materials = [];
    $exercises = [];
    $quizzes = [];
    $encounterAssessmentValue = 0;
    $exerciseAssessmentValue = 0;
    $overallProgress = 0;

    $course = App\Course::findOrFail($id);
    $encounter = \App\Encounter::where('course_id', $course->id)->first();

    if($encounter != null) {
        $answer = $encounter->submittedEncounters()->where(['user_id' => Auth::id()])->first();

        $encounterAssessments[] = DB::table('encounter_assessments')
            ->where('user_id', Auth::id())
            ->where('encounter_id', $encounter->id)
            ->get();
        
        $student_value = 0;
	if ($types != null) {
	    $getTesto = DB::table('encounter_assessments')->where(['encounter_id' => $encounter->id, 'user_id' => Auth::id()])->groupBy('test_to')->orderBy('id', 'DESC')->first();
	    $student_values = DB::table('encounter_assessments')->where(['encounter_id' => $encounter->id, 'user_id' => Auth::id(), 'test_to' => $getTesto->test_to])->get();
	} else {
	    $student_values = DB::table('encounter_assessments')->where(['encounter_id' => $encounter->id, 'user_id' => Auth::id()])->get();
	}

        if ($student_values) {

            foreach($student_values as $sv) {
                $value_criteria = App\Criteria::find($sv->criteria_id);
    
                $student_value += ($sv->value) * ($value_criteria->weight / 100);
            }
    
            $encounterAssessmentValue += $student_value;
        }
    }

    foreach($course->sections as $section) {
        foreach($section->materials as $material) {
            array_push($materials, $material->id);
        }
    }

    foreach($course->sections as $section) {
        foreach($section->exercises as $exercise) {
            array_push($exercises, $exercise->id);
        }
    }

    $videoPerformance = DB::table('viewed_videos')
        ->where('user_id', Auth::id())
        ->whereIn('material_id', $materials)
        ->get();


    $exercisePerformance = DB::table('user_exercises')
        ->where('user_id', Auth::id())
        ->whereIn('exercise_id', $exercises)
        ->get();

    // $quizPerformance = DB::table('user_quizzes')
    //     ->where('user_id', Auth::id())
    //     ->whereIn('quiz_id', $quizzes)
    //     ->get();

    if(collect($materials)->count() < 1) {
        $videoProgress = 0;
    } else {
        $videoProgress = $videoPerformance->count() / collect($materials)->count() * 100;
    }

    if(collect($exercises)->count() < 1 && collect($quizzes)->count() < 1) {
        $exerciseProgress = 0;
    } else {
        //$exerciseProgress = $exercisePerformance->count() / collect($exercises)->count() * 100;
        $exerciseProgress = ($exercisePerformance->count() + $course->essayPerformance()->count()) / (collect($exercises)->count() + collect($course->essayIds())->count()) * 100;
    }

    $encounterProgress = $answer != null ? 1 * 100 : 0;

    $overallProgress = ($videoProgress * (30 / 100)) + ($exerciseProgress * (20 / 100)) + ($encounterProgress * (50 / 100));

    foreach($exercises as $exercise) {
        $student_value = 0;
        $student_values = DB::table('exercise_assessments')->where('exercise_id', $exercise)->where('user_id', Auth::id())->get();

        foreach($student_values as $sv)
        {
            $value_criteria = App\ExerciseCriteria::find($sv->criteria_id);

            $student_value += ($sv->value) * ($value_criteria->weight / 100);
        }

        $exerciseAssessmentValue += $student_value;
    }

    return [
        'answer' => $answer,
        'encounterAssessments' => $encounterAssessments,
        'materials' => $materials,
        'exercises' => $exercises,
        'quizzes' => $quizzes,
        'encounterAssessmentValue' => $encounterAssessmentValue,
        'exerciseAssessmentValue' => $exerciseAssessmentValue,
        'overallProgress' => $overallProgress
    ];
}

function limit_text($string) {
    $string = strip_tags($string);
    if (strlen($string) > 25) {

        // truncate string
        $stringCut = substr($string, 0, 25);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
        $string .= '...';
    }
    return $string;
}

function boom_log($user_id) {
    $logs = App\Log::find(['user_id' => $user_id]);

    return $logs;
}

function get_badge($sumPoint, $type){
    if ($type == 'badge') {
        if($sumPoint <= 399){
        $hasil = "bedg_cyan.png";
        }
        if($sumPoint >= 399 and $sumPoint <= 2999){
            $hasil = "bedg_red.png";
        }
        if($sumPoint >= 2999 and $sumPoint <= 6999){
            $hasil = "bedg_blue.png";
        }
        if($sumPoint >= 6999 and $sumPoint <= 10000){
            $hasil = "bedg_yellow.png";
        }
        if($sumPoint >= 10000 and $sumPoint <= 18000){
            $hasil = "bedg_green.png";
        }
        if($sumPoint >= 18000){
            $hasil = "bedg_green.png";
        }
    }
    if ($type == 'level') {
        if($sumPoint <= 399){
            $hasil = "Newbie";
        }
        if($sumPoint >= 399 and $sumPoint <= 2999){
            $hasil = "Trained";
        }
        if($sumPoint >= 2999 and $sumPoint <= 6999){
            $hasil = "Super";
        }
        if($sumPoint >= 6999 and $sumPoint <= 10000){
            $hasil = "Geek";
        }
        if($sumPoint >= 10000 and $sumPoint <= 18000){
            $hasil = "Freak";
        }
        if($sumPoint >= 18000){
            $hasil = "Master";
        }
    }
    // Rajin=>80, Sangat Rajin=50, Malas=30, Jarang Aktif=10
    /**
     * 1. Get user id
     * 2. Get user course
     * 3. Count course materials
     * 4. Get user viewed video
     * 
     */
    if ($type == 'activity') {
        if ($sumPoint <= 20) {
            $hasil = "Jarang Aktif";
        }
        if ($sumPoint >= 20 and $sumPoint <= 60) {
            $hasil = "Malas";
        }
        if ($sumPoint >= 60 and $sumPoint <= 80) {
            $hasil = "Rajin";
        }
        if ($sumPoint >= 80) {
            $hasil = "Sangat Rajin";
        }
    }
    return $hasil;
}

function getNilaiByTest($test_to, $enc_id, $user_id) {
    $encounter = App\Encounter::findOrFail($enc_id);
    $schedules = $encounter->schedule->where('encounter_id', $enc_id)->where('test_to', $test_to)->where('user_id', $user_id);

    $new_nilai = [];
    foreach ($encounter->criterias as $criteria) {
        foreach ($schedules as $schedule) {
            $user = $criteria->assessedEncounters->where('id', $user_id)->where('pivot.schedule_id', $schedule->id)->first();
            if (!empty($user)) {
                $new_nilai[$criteria->id][$user->pivot->test_to] = $user->pivot->value;
            }
        }
    }

    // dump($new_nilai);

    $student_value = 0;
    $data= [];
    foreach($new_nilai as $id_c => $sv) {
        $value_criteria = \App\Criteria::find($id_c);
        
        if (array_key_exists($test_to, $sv)) {

            $student_value += ($sv[$test_to]) * ($value_criteria->weight / 100);
            $data['nilai'] = $student_value;
        }
    }
    
    return (!empty($data)) ? round($data['nilai']) : '-';
}

function my_encrypt($data)
{
    $key = 'qwertyuiopasdfghjklzxcvbnm1234567890';
        // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
        // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
        // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    return base64_encode($encrypted . '::' . $iv);
}

function my_decrypt($data)
{
    $key = 'qwertyuiopasdfghjklzxcvbnm1234567890';
        // Remove the base64 encoding from our key
    $encryption_key = base64_decode($key);
        // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

function profile_progress()
{
    $out = 0;
    if (count(auth()->user()->userDetail->where('type', 'work'))>0) {
        $out += 25;
    }
    if (count(auth()->user()->userDetail->where('type', 'school'))>0) {
        $out += 25;
    }
    if (count(auth()->user()->userDetail->where('type', 'jobs'))>0) {
        $out += 25;
    }
    if (!empty(auth()->user()->photo) && auth()->user()->photo !== 'default.png') {
        $out += 25;
    }
    $t_progress = $out;
    return round($t_progress);
}

function profile_status($param) {
    if ($param > 0) {
        $output = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAANOSURBVGhD7ZnLbtNAFIYrbgt23FbAY4DgHbhWIG4P0ooHAITEBipxKU1g2wpoaGFbiUrxjImQSMwOFm3jFNHLurAx55+eisg5k4ydsdnklz6prT1n/rmdGU/HRhpppOE1m8zuVz/VORWru8SbINbfVEdvB7H6A/jnCM/MO/RukiT7uPj/U9gOT6uOekAGYyLJSNuUXVOnOFx5asSN41T5i6CjfgvGMoEYNDpPEZPDFysd69tU8VbayLBQQzYQm6vxryiKDlGvT0uV+4TWz7NG0jjI1foRDe9hWnwfpQoLIdYfUCdXP5xMz5dp/h81LyNRxrSxgenENvKpHus7UuAyCdrhDbaTTZ86X05QZtiUgpaJyU5tfYxtuQvDJwUsioUfi+LfAXmZYltuwg7rY5Nypdp6lVycv5o8DB+Jz+Glvlo/yfYGi48HYjDf7Jm/8O6KwdYI8nSf7fUXDllUgM4pUhC/pM0D/P7+e+90olFYdToA0oI5ny5cBDbzlagqvg/q65/Psk27zHFXKOyTSut1ZvOAFvMk27SLhuqtVNgXNvMzNCLS+91QA+bYpl3mw0Mo7INhzAPy1mKbdtGL2+mCNvrl7jQwf2l+PLd5QLNjk23a5Zr/ke5gYNC8BT7MA3hjm3a5NADmXY3YzQ9ueBqnBtCLfacQcjQMuBiqRv7MA7cpRAtFKtyNLYd3G/Nt3hDrJtu0y1x9SIVT2DLKy1bFah7PpFiuOKXRLBuZrRFFmAfUgAm2aZe5oBIK25AWaTe+zIOwE55hm3bhwBR09JoUwIatEcZ80495WsBuhzkIR1cpSD/S896neUCdeo/tDRau+1z2gzRoxOXauHfz1KE7mT5oIFz3ycH6g0ZMN2fEZ3mh3n/CttyFD2lsHFLAUonVL+r9o2wrm6jwLTFoieh1fZ3t5BPl3udS4HJQj9lGfu1e6upab/DCqeEfJ2xjOOGilUZiUaikECiBLHi73N0TLlqpEYVfdiHjLCVLB7ha/wrawU3KThtS5cOwG1Nd42qKlUmxsZ7Ks9n1onbQ68sry0c4fHnCjo1jBzVkRTZnB2VwPMi8wxYhHLJw6USjMknM4cODTG5hhHiU8D+1r3hGTOBU6XwwG2mkkfpobOwvmYsTyLH4YP8AAAAASUVORK5CYII=';
    } else {
        $output = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAM2SURBVGhD7ZnLbtNAFIYjbgt23FbAC7BCSmYIUqWIcalYsCTitoMtrItgwQKJdE0rlcsjoCJVFCQeAygPAJQNAVTiJCqgZjhneiyF5Iztie1JkfxLnxTLM+f8x554xuNKqVKlsks3m3t7s7LeVfIusNINxAfgRxjI3wj+7gZy3ZyDNthW36/soe7TU3+udhIMLoRKfAGD2oUwEBvYt9eQJyicP3Ua1aOhkk+BX5w5FzAGFLKMMSl8sYIrd62rxHfOTEbaGJvS5C/dPHUArtQzJnGuQBGPdbW6n9LmI32xehDMv+YSFgEU8QpzUvpsoivvzXwEFLGay53wMWxs4HAiG5MJAlznAvskDGqXyY6bOhdOH4NJ5xsX1DPtn4E4QrbSC28fE2xKiCWylU5mhnWZpM7Xdf/2Tf4cg2kLfbhzHOilp+rHyV6y4I+7wAViASN/3qxpvb2ttx7c49sMgW2wLfZxLKJF9uKFiywYPhtckDEi85ESiojMR3IpAgr4lGoB2A/EWS4AR//WjX8MGVmKGDVvBMcYY7StjZ6qSrJpl1kSM51t2IwNF5GmTSpmxR2yaReM/xds5xjiDOZm3iCek027oOH6eMdkWKMDOB4M6IA0sXlAyfdk0y56e+IDJMAWMaws5hGYWMmmXU7PfwZTBF75UcGdyGQeQG9k0658ChgZNigoyksB//0Qwj8K2zkB1jzeidHhlKUIJd6RTbuggBW2cwyseTIad46LFU+ax+hunsiUmCebdpkNKq4zg/elRFATZNMuWsx95gKMsRsXcyho3OKCsERFJJiPiIpwMY+ESjwke8nC7T6n+QCMFPxCs+X0QoOCRd0yF2w6iEWylV74Io0TBx/QI0p+3ZyrHyZbbgrPyatsUI/A8GmSnckEf54nXGAvKPmIbEyuna1FscomKBDMiR9OyEY2mc1dJda4REUAw+Zlbpu7kXCj1c9ml1jUjcY+Spu/QnXmCiRqjyfOTLuj5CVKU6zMIzYQS06TnQWcpPCqb87MHKLw/kQzdgv4yJmLA/vg8sB5hi1CuMjCTSfct8E1O7544Hc0vEPIzjc18ZbOzeOqMvXCrFSpUjGqVP4C/xYkeiCFjZAAAAAASUVORK5CYII=';
    }
    return $output;
}
function findBranch($id, $type) {
    if ($type=='id') {
        $branch = \App\Branch::find($id);
    }

    return $branch;
}

function getUserData($id, $bol=false) {
    if ($bol == true) {
        $user = User::findOrFail($id);
        return $user;
    }
}

function getWilayahIdn($country) {
    if ($country == 'id')
    {
        $http = new Client;
        $response = $http->request('GET', 'https://raw.githubusercontent.com/nolimitid/nama-tempat-indonesia/master/json/kota-kabupaten.json');
        $res = json_decode($response->getBody(), true);
    }
    return $res;
}

function percent($price, $disc)
{
    $jarak = $price - $disc;
    $per = ($jarak / $price) * 100;
    return round($per);
}

function unique_multidim_array($array, $key)
{
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach ($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
} 

function user_credits()
{
    $my_credits = 0;
    $users = auth()->user();
    $credit = $users->creditColect;
    $is_credit = 0;
    if ($credit->count()>0) {
        foreach ($credit as $key => $value) {
            $sum[] = $value->credit;
        }
        $my_credits = $is_credit = array_sum($sum);
    }
    $decreas = [];
    $course = 0;
    foreach ($users->creditCourse as $c_sum) {
        $course += $c_sum->credit;
    }
    array_push($decreas, $course);
    $package = 0;
    foreach ($users->creditPackage as $p_sum) {
        $package += $p_sum->credit;
    }
    array_push($decreas, $package);
    $jum_dec = array_sum($decreas);
    if (!empty($is_credit) && !empty($jum_dec)) {
        $my_credits = $is_credit - $jum_dec;
    }
    return $my_credits;
}

function getChat()
{
    $ask = false;
    $users = auth()->user();
    $chat = (!empty($users->userUpshellCollect())) ? $users->userUpshellCollect()->first() : null;
    if (!empty($chat)) {
        $expired = Carbon::parse($chat->pivot->expired_at);
        if ($expired < Carbon::now()) {
            $ask = true;
        }
    }
    return $ask;
}

function myPackageProgress($id, $types)
{
    $mycourse = CoursePackage::find($id);
    $countable = (empty($mycourse->packages->count())) ? 0 : $mycourse->packages->count();
    $countCerCourse = 0;
    foreach ($mycourse->packages as $courses) {
        $countCerCourse += $courses->eCertificate()->count();
    }
    if ($types == 'count') {
        return $countCerCourse . ' / ' . $mycourse->packages->count();
    }

    if ($types == 'progress') {
        $t_tol = (100 / $countable) * $countCerCourse;
        return $t_tol;
    }
}

function myCourseProgress($id)
{
    $myCourse = Course::find($id);
    $completedLesson = $myCourse->topProgressBar();
    $enc = (!empty($myCourse->encounters)) ? $myCourse->encounters->first() : null;
    $subEnc = ($enc !== null) ? $enc->submittedEncounters()->where(['user_id' => Auth::id()])->first() : null;
    $encounterProgress = $subEnc != null ? 1 * 10 : 0;
    return round($completedLesson) + round($encounterProgress);
}

function zoom_jwt_token()
{
    //Zoom API credentials from https://developer.zoom.us/me/
    $key = config('services.zoom_jwt.cliend_id');
    $secret = config('services.zoom_jwt.client_secret');
    $token = array(
        "iss" => $key,
        // The benefit of JWT is expiry tokens, we'll set this one to expire in 1 minute
        "exp" => time() + 300
    );
    // Generate token
    $jwt = JWT::encode($token, $secret);
}

function get_datetime($date = null, $add = 0, $f, $fr)
{
    $date = new DateTime($date);
    $date->add(new DateInterval('P' . $add . $f));
    return $date->format($fr);
}

function getExcerciesPg(int $id)
{
    $nilai = [];
    $e_pg = \App\EssayPilihanGanda::with('answersPg')->where('section_id', $id)->get();
    $te_pg = count($e_pg);
    // dd($e_pg);
    $n_total = round(100/$te_pg);
    foreach ($e_pg as $epg)
    {
        if (!empty($epg->answersPg)) {
            if ($epg->answersPg->answer == $epg->option_true)
            {
                array_push($nilai, $n_total);
            } else {
                array_push($nilai, 0);
            }
        } else {
            array_push($nilai, 0);
        }
    }
    return round(array_sum($nilai));
}
