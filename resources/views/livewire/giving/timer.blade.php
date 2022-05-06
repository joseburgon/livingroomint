<div x-data="initTimer()" id="timer">
    <div class="base-timer">
        <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <g class="base-timer__circle">
                <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
                <path
                    id="base-timer-path-remaining"
                    stroke-dasharray="283"
                    class="base-timer__path-remaining"
                    :class="remainingPathColor"
                    d="
                                  M 50, 50
                                  m -45, 0
                                  a 45,45 0 1,0 90,0
                                  a 45,45 0 1,0 -90,0
                                "
                ></path>
            </g>
        </svg>
        <span x-text="formatTime(timeLeft)" id="base-timer-label" class="base-timer__label"></span>
    </div>
</div>

@push('scripts')
    <script>
        const COLOR_CODES = {
            info: {
                color: "green"
            },
            warning: {
                color: "orange",
                threshold: 300
            },
            alert: {
                color: "red",
                threshold: 120
            }
        };

        function initTimer() {
            return {
                active: @entangle('active'),
                maxTime: @entangle('maxTime'),
                expirationTime: @entangle('expirationTime'),
                fullDashArray: 283,
                timeLimit: 1800,
                timePassed: 0,
                timeLeft: 1800,
                timerInterval: null,
                remainingPathColor: COLOR_CODES.info.color || 'green',
                startTimer() {
                    this.timerInterval = setInterval(() => {
                        this.timePassed = this.timePassed += 1;
                        this.timeLeft = this.timeLimit - this.timePassed;
                        this.setCircleDasharray();
                        this.setRemainingPathColor(this.timeLeft);

                        if (this.timeLeft === 0) {
                            this.onTimesUp();
                        }
                    }, 1000);
                },
                formatTime(time) {
                    const minutes = Math.floor(time / 60);
                    let seconds = time % 60;

                    if (seconds < 10) {
                        seconds = `0${seconds}`;
                    }

                    return `${minutes}:${seconds}`;
                },
                setRemainingPathColor(timeLeft) {
                    const {alert, warning} = COLOR_CODES;
                    if (timeLeft <= alert.threshold) {
                        this.remainingPathColor = alert.color
                    } else if (timeLeft <= warning.threshold) {
                        this.remainingPathColor = warning.color
                    }
                },
                calculateTimeFraction() {
                    const rawTimeFraction = this.timeLeft / this.timeLimit;
                    return rawTimeFraction - (1 / this.timeLimit) * (1 - rawTimeFraction);
                },
                setCircleDasharray() {
                    const circleDasharray = `${(
                        this.calculateTimeFraction() * this.fullDashArray
                    ).toFixed(0)} 283`;
                    document
                        .getElementById("base-timer-path-remaining")
                        .setAttribute("stroke-dasharray", circleDasharray);
                },
                onTimesUp() {
                    clearInterval(this.timerInterval);
                },
                init() {
                    this.$watch('active', (isActive) => {
                        this.timeLimit = this.maxTime
                        this.timePassed = this.maxTime - this.expirationTime

                        if (isActive) {
                            console.log(`activated`)
                            this.startTimer()
                        } else {
                            this.onTimesUp()
                        }
                    })
                }
            }
        }

    </script>
@endpush
