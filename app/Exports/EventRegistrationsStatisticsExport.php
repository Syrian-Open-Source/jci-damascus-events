<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EventRegistrationsStatisticsExport implements FromCollection,WithHeadings,WithColumnWidths,WithStyles
{
    use Exportable;

    private Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $event = $this->event;
        $result = [];
        foreach ($event->foodTables as $table) {

            $result[$table->id] = [];
            foreach ($table->chairTable as $chair) {

                if (!$chair->user) {
                    continue;
                }
                $result[$table->id][] = [
                    'table' => $table->title,
                    'user' => $chair->user->name ?? '',
                    'user_phone' => $chair->user->phone ?? '',
                    'selected_food' =>  $chair->user->menuItems->map(function ($item) {
                        return $item->title;
                    })->join(', '),
                ];
            }

            if (!sizeof($result[$table->id])) {
                unset($result[$table->id]);
            }

        }

        return collect($result);
    }


    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return [
            'table',
            'user',
            'phone',
            'food',
        ];
    }

    public function columnWidths(): array
    {
       return [
           'A' => 20,
           'B' => 40,
           'C' => 40,
           'D' => 20,
       ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 16]],
        ];
    }
}
