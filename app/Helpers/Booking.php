<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Slots;
use App\Constants\BookingStatus;

class Booking {
    
    private $startTime = '0800'; // Bat dau luc 8h sáng
    private $endTime = '2100';
    private $diffTime = 60; // Khoang cach la 30p
    private $diffDate = 6;
    private $bookingTime = [];
    private $bookingDate = [];
    private $startDate = '';
    private $endDate = '';
    private $numberOfSlot = 4;
    public static $instance;
    
    public function __construct() {
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    
    /**
     * @return array <multitype:, multitype:>
     */
    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    /**
     * @return number
     */
    public function getDiffDate()
    {
        return $this->diffDate;
    }

    /**
     * @param number $diffDate
     */
    public function setDiffDate($diffDate)
    {
        $this->diffDate = $diffDate;
    }

    /**
     * @return number
     */
    public function getNumberOfSlot()
    {
        return $this->numberOfSlot;
    }

    /**
     * @param number $numberOfSlot
     */
    public function setNumberOfSlot($numberOfSlot)
    {
        $this->numberOfSlot = $numberOfSlot;
    }

    /**
     * @return string
     */
    public function getStartTime()
    {
        return Carbon::parse($this->startTime)->format('H:i');
    }

    /**
     * @return string
     */
    public function getEndTime()
    {
        return Carbon::parse($this->endTime)->format('H:i');
    }

    /**
     * @return string
     */
    public function getDiffTime()
    {
        return $this->diffTime;
    }

    /**
     * @return string
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param string $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @param string $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @param string $diffTime
     */
    public function setDiffTime($diffTime)
    {
        $this->diffTime = $diffTime;
    }

    /**
     * @param multitype: $bookingTime
     */
    public function setBookingTime($bookingTime)
    {
        $this->bookingTime = $bookingTime;
    }

    /**
     * @param multitype: $bookingDate
     */
    public function setBookingDate($bookingDate)
    {
        $this->bookingDate = $bookingDate;
    }

    /**
     * @param string $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @param string $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return multitype:
     */
    public function getBookingTime()
    {
        $start_time = Carbon::parse($this->getStartTime());
        $end_time   = Carbon::parse($this->getEndTime());

        while(1) {
            
            $this->bookingTime[$start_time->format('H:i')] = [];
            
            $start_time = $start_time->addMinutes($this->getDiffTime());
            
            if($start_time->greaterThan($end_time)) {
                break;
            }
            
        }
        return $this->bookingTime;
    }

    /**
     * @return multitype:
     */
    public function getBookingDate($condition = [])
    {
        $current_date = Carbon::now();
        
        if(isset($condition['current_date'])) {
            $cd = explode('/', $condition['current_date']);
            $current_date = Carbon::create($cd[2], $cd[1], $cd[0]);
        }
        
        $start_date = Carbon::now();
        $end_date = $start_date->copy()->addDay($this->getDiffDate());
        $diffDate = $start_date->diff($end_date);
        
        if(isset($condition['start_date'])) {
            $sd = explode('/', $condition['start_date']);
            $start_date = Carbon::create($sd[2], $sd[1], $sd[0]);
        }
        
        if(isset($condition['end_date'])) {
            $ed = explode('/', $condition['end_date']);
            $end_date = Carbon::create($ed[2], $ed[1], $ed[0]);
        }
        
        if(isset($condition['prev']) && $condition['prev'] === 'true') {
            $start_date = $start_date->subDays(1);
            $end_date = $end_date->subDay(1);
        }
        
        if(isset($condition['next']) && $condition['next'] === 'true') {
            $start_date = $start_date->addDay(1);
            $end_date = $end_date->addDay(1);
        }
        
        $this->setStartDate($start_date->format('d/m/Y'));
        $this->setEndDate($end_date->format('d/m/Y'));
        
        while(1) {
            
            $this->bookingDate[$start_date->format('d/m/Y')] = $this->getBookingTime();
            
            $start_date = $start_date->addDay(1);
            
            if($start_date->greaterThan($end_date)) {
                break;
            }
        }
        
        return $this->bookingDate;
    }

    /**
     * 
     * @return string
     */
    public function makeList($condition = []) {
        $booking_time = $this->getBookingTime();
        $booking_date = $this->getBookingDate($condition);
        
        $wheres = [
            ['booking_time', '>=', $this->getStartDate()],
            ['booking_time', '<=', $this->getEndDate()],
            ['avail_flg', '=', 0]
        ];
        
        $slots = Slots::select('booking_time', 
                                DB::raw('GROUP_CONCAT(id ORDER BY id) AS slot_id'), 
                                DB::raw('GROUP_CONCAT(name ORDER BY id) AS name'), 
                                DB::raw('GROUP_CONCAT(phone_number ORDER BY id) AS phone_number'), 
                                DB::raw('GROUP_CONCAT(note ORDER BY id) AS note'), 
                                DB::raw('GROUP_CONCAT(status ORDER BY id) AS status'))->where($wheres)->groupBy('booking_time')->get()->keyBy('booking_time')->toArray();
        $newSlot = [
            'id'            => -1,
            'name'          => '',
            'phone_number'  => '',
            'note'          => '',
            'status' => BookingStatus::AVAILABLE
        ];
        
        foreach($booking_date as $date=>$times) {
            foreach($times as $time=>$value) {
                $datetime = $date . ' ' . $time;
                $cntSlot = 0;
                if(isset($slots[$datetime])) {
                    $ids            = explode(',', $slots[$datetime]['slot_id']);
                    $phone_numbers  = explode(',', $slots[$datetime]['phone_number']);
                    $names          = explode(',', $slots[$datetime]['name']);
                    $statuss        = explode(',', $slots[$datetime]['status']);
                    $notes          = explode(',', $slots[$datetime]['note']);
                    
                    foreach($ids as $k=>$id) {
                        $slot = [
                            'id'            => $id,
                            'name'          => isset($names[$k]) ? $names[$k] : '',
                            'phone_number'  => isset($phone_numbers[$k]) ? $phone_numbers[$k] : '',
                            'note'          => isset($notes[$k]) ? $notes[$k] : '',
                            'status'        => isset($statuss[$k]) ? $statuss[$k] : '',
                        ];
                        
                        array_push($booking_date[$date][$time], $slot);
                        
                        $cntSlot++;
                    }
                }
                
                if($cntSlot < $this->getNumberOfSlot()) {
                    array_push($booking_date[$date][$time], $newSlot);
                }
            }
        }
        
        $start_date = $this->getStartDate();
        $end_date = $this->getEndDate();
        
        return view('helpers.booking.booking_table', compact('booking_date', 'booking_time', 'start_date', 'end_date'))->render();
    }
    
    /**
     * 
     * @param array $data
     * @return boolean
     */
    public function createSlot($data = null) {
        
        if(is_null($data)) {
            return false;
        }
        
        $slot = new Slots();
        if(isset($data['slot_id']) && $data['slot_id'] != -1) {
            $slot = Slots::find($data['slot_id']);
        }
        $slot->booking_time = $data['booking_date'] . ' ' . $data['booking_time'];
        $slot->name = $data['name'];
        $slot->phone_number = $data['phone_number'];
        $slot->note = $data['note'];
        $slot->status = $data['status'];
        $slot->avail_flg = 0;
        if($data['status'] == BookingStatus::CANCEL) {
            $slot->avail_flg = 1;
        }
        
        if($slot->save()) {
            return $slot;
        }
        
        return false;
    }
    
}
?>