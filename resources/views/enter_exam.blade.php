@extends('layout.layout')
@section('title')
    ورود به آزمون {{$exam->title }}
@endsection
@section('css')

@endsection
@section('content')
    @php
        use Hekmatinasser\Verta\Verta;
        $targetDateTime = new Verta(\Hekmatinasser\Verta\Verta::parse($exam->date.' '. $exam->time));
        $currentDateTime = new Verta();
        $timeRemaining = $targetDateTime->diff($currentDateTime);
        $remainingDays = $timeRemaining->days;
        $remainingHours = $timeRemaining->h;
        $remainingMinutes = $timeRemaining->i;
        $remainingSeconds = $timeRemaining->s;
    @endphp
    @php
        $date = \Hekmatinasser\Verta\Verta::parse($exam->date.' '. $exam->time);
        $endDate = \Hekmatinasser\Verta\Verta::parse($exam->date.' '. $exam->time)->addMinutes($exam->deadline);
        $timeForEnter = $currentDateTime->diffMinutes($endDate);
    @endphp
    <h1 class="text-center mt-5"> ورود به آزمون {{$exam->title }}</h1><br>
    <div class=" d-flex align-items-center justify-content-center bg-body-secondary p-2"
         style="width: fit-content;margin: auto;">
        <form class="p-3" action="{{route('exam',['id'=>$exam->id])}}" method="get">
            @csrf
            <div class="fw-bold">
                زمان شروع ازمون {{$exam->date  }} - {{$exam->time}}
            </div>
            <br>
            <div class="fw-bold">
                مدت زمان ازمون {{$exam->deadline}} دقیقه
            </div>
            <br>
            @if($date->isFuture())
                تا آزمون : <div id="countdown"></div>
            @endif
            @if(!$date->isFuture() && !$endDate->isPast())
                 زمان باقی مانده تا پایان : <div > {{$timeForEnter}}دقیقه</div>
            @endif
            @if($endDate->isPast())
                <button
                        data-mdb-ripple-init
                        type="submit"
                        class="btn btn-danger btn-block mt-3 w-100"
                        disabled
                >
                    آزمون به پایان رسیده
                </button>
            @elseif($date->isFuture())
                <button
                    data-mdb-ripple-init
                    type="submit"
                    class="btn btn-warning btn-block mt-3 w-100"
                    disabled
                >
                    آزمون شروع نشده
                </button>
            @else
                <button
                        data-mdb-ripple-init
                        type="submit"
                        class="btn btn-primary btn-block mt-3 w-100"
                >
                    ورود به آزمون
                </button>
            @endif
        </form>
    </div>
    <script>
        // شمارش معکوس
        function countdown() {
            var days = <?php echo $remainingDays; ?>;
            var hours = <?php echo $remainingHours; ?>;
            var minutes = <?php echo $remainingMinutes; ?>;
            var seconds = <?php echo $remainingSeconds; ?>;

            var countdownElement = document.getElementById("countdown");

            function updateCountdown() {
                countdownElement.innerHTML = days + " روز و " + hours + " ساعت و " + minutes + " دقیقه و " + seconds + " ثانیه";
            }

            function decreaseSecond() {
                if (seconds > 0) {
                    seconds--;
                } else {
                    seconds = 59;
                    decreaseMinute();
                }
                updateCountdown();
            }

            function decreaseMinute() {
                if (minutes > 0) {
                    minutes--;
                } else {
                    minutes = 59;
                    decreaseHour();
                }
            }

            function decreaseHour() {
                if (hours > 0) {
                    hours--;
                } else {
                    hours = 23;
                    decreaseDay();
                }
            }

            function decreaseDay() {
                if (days > 0) {
                    days--;
                } else {
                    clearInterval(countdownInterval);
                    countdownElement.innerHTML = "زمان به پایان رسید.";
                    $('.spinner-container').css({'display':'flex'})
                    location.href = location.href
                }
            }

            updateCountdown();
            var countdownInterval = setInterval(decreaseSecond, 1000);
        }

        // شروع شمارش معکوس بلافاصله پس از بارگذاری صفحه
        window.onload = countdown;
    </script>
@endsection
