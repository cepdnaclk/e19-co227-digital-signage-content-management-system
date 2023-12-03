<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/config.php" ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/helpers/datetime.php" ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/labslots.php" ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . "/backend/functions/course.php" ?>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['date']))
    $today = $_GET['date'];
else
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
if ($clearenceStatus[$_SESSION['clearense']] > 0)
    $courses = getCourses();
else {
    $courses = getCoursesCo($_SESSION['user_id']);
}

if (!$courses)
    header("Location: /pages/labslots/?error=You have no Courses");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/addlabslot.css">
    <title>IT Center | Lab Allocations</title>
</head>

<body>
    <div class="flex-box">
        <div class="left">
            <?php
            include_once(APP_ROOT . "/includes/sidebar.php");
            sidebar(4, 0);
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
                            <h1><a href="./">Lab Allocation ></a>Add a Lab slot :
                                <?= isset($_GET['lab']) ? getLab($_GET['lab']) : '' ?>
                            </h1>
                            <p>Create a labslot for a course</p>
                        </div>
                    </div>
                    <form class="options" method="post" action="/backend/api/labslots/add_update.php">
                        <div class="option">
                            <select name="course" id="course" v-model="course">
                                <?php $i = 0;
                                foreach ($courses as $key => $course) { ?>
                                    <option :value="'<?= $course['c_code'] ?>'">
                                        <?= $course['c_code'] ?>
                                    </option>
                                    <?php $i++;
                                } ?>
                            </select>
                        </div>
                        <div class="option">
                            <label for="date">select date </label>
                            <select name="date" id="date" v-model="date"
                                :style="isonedate ? 'pointer-events: none; opacity: 0.8': ''">
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
                            <input type="checkbox" name="isoneday" id="isonedate" v-model="isonedate"
                                @change="handleIsOneDateChange">
                            <input type="date" name="oneday" id="onedate" v-model="onedate" :disabled="!isonedate"
                                @change="handleOneDateChange" min="<?= date("Y-m-d") ?>">
                        </div>
                        <div class="option">
                            <label for="stime">Select the Start time : </label>
                            <input type="time" name="stime" id="stime" v-model="start" @change="handleStartChange"
                                min="08:00:00" max="16:00:00">
                        </div>
                        <div class="option">
                            <label for="stime">Select the End time : </label>
                            <input type="time" name="etime" id="etime" v-model="end" @change="handleEndChange"
                                min="09:00:00" max="17:00:00">
                        </div>
                        <input type="text" name="lab" id="lab" style="display: none;"
                            value="<?= isset($_GET['lab']) ? $_GET['lab'] : '' ?>">
                        <input type="text" name="update_id" id="updateid" style="display: none;"
                            value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>">
                        <button type="submit" class="add">
                            <?= !isset($_GET['id']) ? 'CREATE SLOT' : 'UPDATE SLOT' ?>
                        </button>
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
                                <p>
                                    <?= $day->format('l') ?>
                                </p>
                                <h3>
                                    <?= $day->format("Y/m/d") ?>
                                </h3>
                            </div>
                        <?php } ?>
                        <?php
                        $startTime = new DateTime("08.00");
                        $endTime = new DateTime("17.00");

                        while ($startTime < $endTime) {
                            ?>
                            <div class="time-slot">
                                <p>
                                    <?= $startTime->format('h:i') . " - " . $startTime->modify("+1 hour")->format('h:i') ?>
                                </p>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        foreach ($labslots as $key => $labslot) {
                            if (!isset($_GET['id']) || $_GET['id'] != $labslot['slot_id'])
                                echo "<lab-slot id='labslot$key' date='{$labslot["date"]}' start='{$labslot["start"]}' end='{$labslot["end"]}' course='{$labslot["course"]}'></lab-slot>";
                            else if (isset($_GET['id']) && $_GET['id'] == $labslot['slot_id'])
                                $currentSlot = $labslot;
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
        <?php
        if (isset($_GET['error'])) { ?>
            alert("<?= $_GET['error'] ?>");
        <?php } ?>

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
                    const row = findGridRow(props.start) + 2;
                    if (row < 2)
                        return 2
                    return row
                });
                const gridCol = computed(() => {
                    const col = parseInt(props.date) + 2;
                    if (col < 2)
                        return 2
                    return col
                });
                const top = computed(() => {
                    return calTop(props.start) + "px";
                });
                const course = computed(() => {
                    return props.course
                });
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
                <?php if (!isset($_GET['id'])) { ?>
                    const course = ref("<?= $courses[0]['c_code'] ?>");
                    const start = ref("<?= "08:00" ?>");
                    const end = ref("<?= "10:00" ?>");
                    const date = ref(<?php
                    $day = (new DateTime($today))->format('w');
                    if ($day == 0)
                        echo 6;
                    else
                        echo $day - 1;
                    ?>)
                    const isonedate = ref(<?= isset($_GET['date']) ? 'true' : 'false' ?>);
                    const onedate = ref("<?= $today ?>");
                <?php } else { ?>
                    const course = ref("<?= $currentSlot['course'] ?>");
                    const start = ref("<?= $currentSlot['start'] ?>");
                    const end = ref("<?= $currentSlot['end'] ?>");
                    const date = ref(<?= $currentSlot['date'] ?>)
                    const isonedate = ref(<?= $currentSlot['oneday'] != null ? 'true' : 'false' ?>);
                    const onedate = ref("<?= $currentSlot['oneday'] != null ? $currentSlot['oneday'] : $today ?>");
                <?php } ?>
                const timeSlots = computed(() => {
                    const slots = [
                        <?php
                        foreach ($labslots as $key => $labslot) {
                            if (!isset($_GET['id']) || $_GET['id'] != $labslot['slot_id'])
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
                    if (freeSlots.value.length) {
                        start.value = freeSlots.value[0].start
                        end.value = freeSlots.value[0].end
                    } else {
                        date.value += 1
                        getFreeSlot()
                        setFreeSlot()
                    }
                }

                const handleOneDateChange = () => {
                    const day = new Date(onedate.value)
                    const today = new Date()
                    if (day > today)
                        window.location = `${window.location.origin}${window.location.pathname}?lab=<?= $_GET['lab'] ?>&date=${day.getFullYear()}-${(day.getMonth() + 1).toString().padStart(2, '0')}-${day.getDate().toString().padStart(2, '0')}`
                    else
                        onedate.value = "<?= $today ?>"
                }

                const handleIsOneDateChange = () => {
                    if (!isonedate.value)
                        window.location = `${window.location.origin}${window.location.pathname}?lab=<?= $_GET['lab'] ?>`
                }

                watch(date, () => {
                    getFreeSlot()
                    setFreeSlot()
                })

                onMounted(() => {
                    getFreeSlot()
                    <?php if (!isset($_GET['id'])) { ?>
                        setFreeSlot()
                    <?php } ?>
                })

                return {
                    course,
                    start,
                    end,
                    date,
                    isonedate,
                    onedate,
                    handleStartChange,
                    handleEndChange,
                    handleOneDateChange,
                    handleIsOneDateChange
                };
            },
        });

        app.component("lab-slot", labSlot);
        app.mount("#app");
    </script>
</body>

</html>