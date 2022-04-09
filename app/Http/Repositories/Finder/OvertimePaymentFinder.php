<?php

namespace App\Http\Repositories\Finder;

use App\Models\Overtime as Model;
use App\Models\Employee;
use App\Models\Reference;
use App\Models\Setting;

class OvertimePaymentFinder extends AbstractFinder
{
    public function __construct()
    {
        $this->query = Model::select(
                                'id',
                                'date',
                                'time_started',
                                'time_ended',
        );
    }

    public function setMonthOfYear(\DateTime $monthOfYear)
    {
        $this->query->whereYear('date', $monthOfYear->format('Y'));
        $this->query->whereMonth('date', $monthOfYear->format('m'));
    }

    public function calculateOvertimePayment2()
    {
        $employeeStatuses = Reference::where('code', 'employee_status')->get();
        $permanent = $employeeStatuses->where('name', 'Tetap')->first()->id;
        $probation = $employeeStatuses->where('name', 'Percobaan')->first()->id;

        $formula = Setting::where('key', 'overtime_method')->first()->expression;

        $overtimeCalculations = $this->query->get()
                                    ->map(function ($employee)
                                    use ($permanent, $probation, $formula) {
                                        $status = $employee->status_id;

                                        //overtime duration every day
                                        $overtimes = $employee->overtimes
                                            ->map(function ($overtime)
                                            use ($status, $permanent, $probation) {
                                            $timeStarted = new \DateTime($overtime->time_started);
                                            $timeEnded = new \DateTime($overtime->time_ended);

                                            $diff = $timeEnded->diff($timeStarted);
                                            $diffInHoursAndMin =  $diff->format('%H:%I:%S');
                                            $diffInHours = (float) $diffInHoursAndMin / 3600;

                                            if ($status == $permanent) {
                                                $overtime->overtime_duration = $diffInHours;
                                            } else if ($status == $probation) {
                                                $overtime->overtime_duration = floor($diffInHours/2);
                                            }
                                        });

                                        $employee->overtimes = $overtimes;
                                        $employee->overtime_duration_total = $overtimes->sum('overtime_duration');

                                        $formula = str_replace('overtime_duration_total', $employee->overtime_duration_total, $formula);
                                        $formula = str_replace('salary', $employee->salary, $formula);

                                        $amount = eval('return ' . $formula . ';');
                                        $employee->amount = $amount;

                                        return $employee;
                                    });

        return $overtimeCalculations;
    }

    public function calculateOvertimePayment()
    {
        $employeeStatuses = Reference::where('code', 'employee_status')->get();
        $permanent = $employeeStatuses->where('name', 'Tetap')->first()->id;
        $probation = $employeeStatuses->where('name', 'Percobaan')->first()->id;
        $formula = Setting::where('key', 'overtime_method')->first()->expression;

        $employees = Employee::select('id', 'status_id', 'name','salary')
                                ->with([
                                    'status' => function ($query) {
                                        $query->select('id', 'name');
                                    },
                                ])->get();



        $employees = $employees->map(function ($employee) use ($permanent, $probation, $formula) {
            $status = $employee->status_id;

            $overtimes = $employee->overtimes
                ->map(function ($overtime)
                use ($status, $permanent, $probation) {
                    $timeStarted = new \DateTime($overtime->time_started);
                    $timeEnded = new \DateTime($overtime->time_ended);

                    $diff = $timeEnded->diff($timeStarted);
                    $diffHours = (float) $diff->h;
                    $diffMinutes = (float) $diff->i / 60;

                    $overtimeDuration = $diffHours + $diffMinutes;

                    if ($status == $permanent)
                        $overtime->overtime_duration = $overtimeDuration;
                    else if ($status == $probation)
                        $overtime->overtime_duration = floor($overtimeDuration/2);

                    return $overtime;
                });

            $employee->overtimes = $overtimes;
            $employee->overtime_duration_total = $overtimes->sum('overtime_duration');

            $formula = str_replace('overtime_duration_total', $employee->overtime_duration_total, $formula);
            $formula = str_replace('salary', $employee->salary, $formula);

            $amount = eval(sprintf('return %s;', $formula));
            $employee->amount = $amount;

            return $employee;
        });

        $calcuation = $employees;
        return $calcuation;
    }
}