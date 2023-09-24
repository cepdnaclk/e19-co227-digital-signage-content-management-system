<?php include_once "../config.php" ?>
<?php include_once "../helpers/datetime.php" ?>
<?php include_once "../backend/labslots.php" ?>

<?php

$today = date("Y-m-d");
$dates = getWeekDates($today);

function getLab(string $lab)
{
    $labName = '';
    switch ($lab) {
        case 'lab1':
            $labName = "Lab 1";
            break;

        case 'lab2':
            $labName = "Lab 2";
            break;

        case 'ccna':
            $labName = "CCNA lab";
            break;

        case 'sr':
            $labName = "Seminar Room";
            break;

        default:
            break;
    }

    return $labName;
}

$labslots = getLabSlots($_GET['lab'], $dates[0], $dates[6]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/addlabslot.css">
    <title>IT Center | Lab Allocations</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(4);
            ?>
        </div>
        <div class="right">
            <?php
            include_once(APP_ROOT . "/includes/header.php");
            ?>
            <main class="addlabslots" id="app">
                <div class="container">
                    <div class="title">
                        <div>
                            <h1><a href="/pages/labslots.php">Lab Allocation ></a>Add a Lab slot : <?= isset($_GET['lab']) ? getLab($_GET['lab']) : '' ?></h1>
                            <p>Create a labslot for a course</p>
                        </div>
                    </div>
                    <form class="options" method="post" action="../backend/labslots.php">
                        <div class="option">
                            <select name="course" id="course" v-model="course">
                                <option value="CCNA">CCNA</option>
                                <option value="IT01">IT01</option>
                                <option value="IT03">IT03</option>
                            </select>
                        </div>
                        <div class="option">
                            <label for="stime">Select the Start time : </label>
                            <input type="time" name="stime" id="stime" v-model="start" @blur="handleStartChange">
                        </div>
                        <div class="option">
                            <label for="stime">Select the End time : </label>
                            <input type="time" name="etime" id="etime" v-model="end" @blur="handleEndChange">
                        </div>
                        <div class="option">
                            <label for="date">select date </label>
                            <select name="date" id="date" v-model="date" :disabled="isonedate">
                                <option value="0">Monday</option>
                                <option value="1">Tuesday</option>
                                <option value="2">Wednesday</option>
                                <option value="3">Thursday</option>
                                <option value="4">Friday</option>
                                <option value="5">Saturday</option>
                                <option value="6">Sunday</option>
                            </select>
                        </div>
                        <div class="option">
                            <label for="isonedate">Only this day </label>
                            <input type="checkbox" name="isoneday" id="isonedate" v-model="isonedate">
                            <input type="date" name="oneday" id="onedate" v-model="onedate" :disabled="!isonedate">
                        </div>
                        <button type="submit" class="add">CREATE SLOT</button>
                    </form>
                    <div class="timetable">
                        <div class="time-caption">
                            <h3>Time</h3>
                        </div>
                        <?php foreach ($dates as $index => $date) { ?>
                            <div class="date">
                                <?php
                                $day = new DateTime($date);
                                ?>
                                <p><?= $day->format('l') ?></p>
                                <h3><?= $day->format("Y/m/d") ?></h3>
                            </div>
                        <?php } ?>
                        <?php
                        $startTime = new DateTime("08.00");
                        $endTime = new DateTime("17.00");

                        while ($startTime < $endTime) {
                        ?>
                            <div class="time-slot">
                                <p><?= $startTime->format('h:i') . " - " . $startTime->modify("+1 hour")->format('h:i') ?></p>
                            </div>
                        <?php
                        }
                        ?>
                        <?php
                        foreach ($labslots as $key => $labslot) {
                            echo "<lab-slot id='labslot$key' date='{$labslot["date"]}' start='{$labslot["start"]}' end='{$labslot["end"]}' course='{$labslot["course"]}'></lab-slot>";
                        }
                        ?>
                        <lab-slot id='currentSlot' :date="date" :start="start" :end="end" :course="course"></lab-slot>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="/js/labslot.js"></script>
    <script src="https://unpkg.com/vue@3.1.1/dist/vue.global.prod.js"></script>
    <script>
        const {
            ref,
            createApp,
            onMounted,
            computed,
            watch
        } = Vue;

        const labSlot = {
            props: ["date", "course", "start", "end"],
            setup(props) {
                const height = computed(() => {
                    return calHeight(props.start, props.end) + "px";
                });
                const gridRow = computed(() => {
                    return findGridRow(props.start) + 2 || 2;
                });
                const gridCol = computed(() => {
                    return parseInt(props.date) + 2 || 2;
                });
                const top = computed(() => {
                    return calTop(props.start) + "px";
                });
                const course = ref(props.course);
                const timeInterval = computed(() => {
                    return `${props.start.slice(0, 5)} - ${props.end.slice(0, 5)}`;
                });

                return {
                    height,
                    gridCol,
                    gridRow,
                    course,
                    timeInterval,
                    top,
                };
            },
            template: `
        <div class="labslot" :style="'height:'+height+';grid-column:'+gridCol+';grid-row:'+gridRow+';transform:translateY('+top+')'">
            <h3>{{course}}</h3>
            <p>{{timeInterval}}</p>
        </div>
      `,
        };


        const app = createApp({
            setup() {
                const course = ref("<?= "CCNA" ?>");
                const start = ref("<?= "08:00" ?>");
                const end = ref("<?= "10:00" ?>");
                const date = ref(<?= "0" ?>);
                const isonedate = ref(<?= "false" ?>);
                const onedate = ref("<?= date("Y-m-d") ?>");

                const timeSlots = computed(() => {
                    const slots = [
                        <?php
                        foreach ($labslots as $key => $labslot) {
                            echo "{id:'labslot$key', date:'{$labslot["date"]}', start:'{$labslot["start"]}', end:'{$labslot["end"]}', course:'{$labslot["course"]}'},";
                        }
                        ?>
                    ]

                    return slots.reduce((result, obj) => {
                        const key = obj['date'];
                        if (!result[key]) {
                            result[key] = [];
                        }
                        result[key].push(obj);
                        return result;
                    }, []);
                })

                const freeSlots = ref()

                const handleStartChange = () => {
                    start.value = clipTime(start.value, "08:00", "16:00")
                    if (start.value > end.value) {
                        const startJS = selectedTimeAsDate(start.value)
                        end.value = `${startJS.getHours() + 1}:00`
                    }
                    if (!clashCheck(start.value, end.value)) {
                        setFreeSlot()
                    }
                }

                const handleEndChange = () => {
                    end.value = clipTime(end.value, "09:00", "17:00")
                    if (start.value > end.value) {
                        const endJS = selectedTimeAsDate(end.value)
                        start.value = `${endJS.getHours() - 1}:00`
                    }
                    if (!clashCheck(start.value, end.value)) {
                        setFreeSlot()
                    }
                }

                const clashCheck = (start, end) => {
                    if (Array.isArray(freeSlots.value)) {
                        for (const slot of freeSlots.value) {
                            if (selectedTimeAsDate(start) >= selectedTimeAsDate(slot.start) && selectedTimeAsDate(end) <= selectedTimeAsDate(slot.end)) {
                                return true
                            }
                        }
                    }
                    return false;
                };

                const getFreeSlot = () => {
                    freeSlots.value = [{
                        start: "08:00",
                        end: "17:00"
                    }]
                    if (Array.isArray(timeSlots.value[date.value])) {
                        const occupiedSlots = timeSlots.value[date.value];

                        for (const occupiedSlot of occupiedSlots) {
                            for (let i = 0; i < freeSlots.value.length; i++) {
                                const freeSlot = freeSlots.value[i];

                                // Convert slot times to Date objects for easier comparison
                                const start = selectedTimeAsDate(freeSlot.start);
                                const end = selectedTimeAsDate(freeSlot.end);
                                const occupiedStart = selectedTimeAsDate(occupiedSlot.start);
                                const occupiedEnd = selectedTimeAsDate(occupiedSlot.end);

                                // Check if the occupied slot overlaps with the free slot
                                if (start <= occupiedEnd && end >= occupiedStart) {
                                    // If there is an overlap, split the free slot into two parts
                                    if (start < occupiedStart) {
                                        freeSlots.value.splice(i, 0, {
                                            start: freeSlot.start,
                                            end: occupiedSlot.start,
                                        });
                                        i++; // Skip the newly inserted free slot
                                    }
                                    if (end > occupiedEnd) {
                                        freeSlot.start = occupiedSlot.end;
                                    } else {
                                        // Remove the fully occupied free slot
                                        freeSlots.value.splice(i, 1);
                                        i--; // Adjust index since one element was removed
                                    }
                                }
                            }
                        }
                    }
                };

                const setFreeSlot = () => {
                    start.value = freeSlots.value[0].start
                    end.value = freeSlots.value[0].end
                }

                watch(date, () => {
                    getFreeSlot()
                    setFreeSlot()
                })

                onMounted(() => {
                    getFreeSlot()
                    setFreeSlot()
                })

                return {
                    course,
                    start,
                    end,
                    date,
                    isonedate,
                    onedate,
                    handleStartChange,
                    handleEndChange
                };
            },
        });

        app.component("lab-slot", labSlot);
        app.mount("#app");
    </script>
</body>

</html>