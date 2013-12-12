@extends('layouts.body')

@section('content')
    <?php 
    $correctNumAnswers = $correctNumAnswers[0];
    $cnt = 0; 
    $numberOfCorrectAnswersAttacker = $correctNumAnswers['attacker_num_correct_ans'];
    $numberOfCorrectAnswersDefender = $correctNumAnswers['defender_num_correct_ans'];
    ?>
    <div class="report col-xs-12">
        <b>Attacker</b>
        Correct: {{ $numberOfCorrectAnswersAttacker }}
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <b>Defender</b>
        Correct: {{ $numberOfCorrectAnswersDefender }}
    </div>
    <div class="report col-xs-12">
        @foreach($questions as $question)
            <?php
            $shuffle = $shuffles[$cnt];

            switch($shuffle)
            {
                case 1:
                    $answer1 = $question['answer_1'];
                    $answer2 = $question['answer_2'];
                    $answer3 = $question['answer_3'];
                    $answer4 = $question['answer_correct'];
                break;

                case 2:
                    $answer2 = $question['answer_1'];
                    $answer1 = $question['answer_2'];
                    $answer4 = $question['answer_3'];
                    $answer3 = $question['answer_correct'];
                break;

                case 3:
                    $answer3 = $question['answer_1'];
                    $answer4 = $question['answer_2'];
                    $answer1 = $question['answer_3'];
                    $answer2 = $question['answer_correct'];
                break;

                case 4:
                    $answer4 = $question['answer_1'];
                    $answer2 = $question['answer_2'];
                    $answer3 = $question['answer_3'];
                    $answer1 = $question['answer_correct'];
                break;

                case 5:
                    $answer4 = $question['answer_1'];
                    $answer3 = $question['answer_2'];
                    $answer1 = $question['answer_3'];
                    $answer2 = $question['answer_correct'];
                break;

                case 6:
                    $answer2 = $question['answer_1'];
                    $answer3 = $question['answer_2'];
                    $answer1 = $question['answer_3'];
                    $answer4 = $question['answer_correct'];
                break;

                case 7:
                    $answer4 = $question['answer_1'];
                    $answer2 = $question['answer_2'];
                    $answer1 = $question['answer_3'];
                    $answer3 = $question['answer_correct'];
                break;

                case 8:
                    $answer3 = $question['answer_1'];
                    $answer4 = $question['answer_2'];
                    $answer2 = $question['answer_3'];
                    $answer1 = $question['answer_correct'];
                break;
            }

            $groupName="question".$cnt;     
            ?>
            <div class="report-item text-center row">
                <div class="report-question col-xs-12">
                {{ $question['question'] }}
                </div>
                <div class="report-answers col-xs-12">
                    <div class="report-answer row">
                        <div class="answer-image-placeholder col-xs-2">
                            @if ($attackerAnswers[$cnt] == 1)
                                @if ($attackerAnswers[$cnt] == $correctAnswers[$cnt])
                                    <img src="/img/correct.png" />
                                @else
                                    <img src="/img/wrong.png" />
                                @endif
                            @endif
                        </div>
                        <div class="report-answer-text col-xs-8 @if($correctAnswers[$cnt] == 1)correct-answer@endif">
                            {{ $answer1 }}
                        </div>
                        <div class="answer-image-placeholder col-xs-2">
                            @if ($defenderAnswers[$cnt] == 1)
                                @if ($defenderAnswers[$cnt] == $correctAnswers[$cnt])
                                    <img src="/img/correct.png" />
                                @else
                                    <img src="/img/wrong.png" />
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="report-answer row">
                        <div class="answer-image-placeholder col-xs-2">
                            @if ($attackerAnswers[$cnt] == 2)
                                @if ($attackerAnswers[$cnt] == $correctAnswers[$cnt])
                                    <img src="/img/correct.png" />
                                @else
                                    <img src="/img/wrong.png" />
                                @endif
                            @endif
                        </div>
                        <div class="report-answer-text col-xs-8 @if($correctAnswers[$cnt] == 2)correct-answer@endif">
                            {{ $answer2 }}
                        </div>
                        <div class="answer-image-placeholder col-xs-2">
                            @if ($defenderAnswers[$cnt] == 2)
                                @if ($defenderAnswers[$cnt] == $correctAnswers[$cnt])
                                    <img src="/img/correct.png" />
                                @else
                                    <img src="/img/wrong.png" />
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="report-answer row">
                        <div class="answer-image-placeholder col-xs-2">
                            @if ($attackerAnswers[$cnt] == 3)
                                @if ($attackerAnswers[$cnt] == $correctAnswers[$cnt])
                                    <img src="/img/correct.png" />
                                @else
                                    <img src="/img/wrong.png" />
                                @endif
                            @endif
                        </div>
                        <div class="report-answer-text col-xs-8 @if($correctAnswers[$cnt] == 3)correct-answer@endif">
                            {{ $answer3 }}
                        </div>
                        <div class="answer-image-placeholder col-xs-2">
                            @if ($defenderAnswers[$cnt] == 3)
                                @if ($defenderAnswers[$cnt] == $correctAnswers[$cnt])
                                    <img src="/img/correct.png" />
                                @else
                                    <img src="/img/wrong.png" />
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="report-answer row">
                        <div class="answer-image-placeholder col-xs-2">
                            @if ($attackerAnswers[$cnt] == 4)
                                @if ($attackerAnswers[$cnt] == $correctAnswers[$cnt])
                                    <img src="/img/correct.png" />
                                @else
                                    <img src="/img/wrong.png" />
                                @endif
                            @endif
                        </div>
                        <div class="report-answer-text col-xs-8 @if($correctAnswers[$cnt] == 4)correct-answer@endif">
                            {{ $answer4 }}
                        </div>
                        <div class="answer-image-placeholder col-xs-2">
                            @if ($defenderAnswers[$cnt] == 4)
                                @if ($defenderAnswers[$cnt] == $correctAnswers[$cnt])
                                    <img src="/img/correct.png" />
                                @else
                                    <img src="/img/wrong.png" />
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <?php $cnt++; ?>
        @endforeach
    </div>
@stop