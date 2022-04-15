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
     * @return \App\Models\Event
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
                $result[$table->id]['user'] = $chair->user->name ?? '';
                $result[$table->id]['selected_food'] = $chair->user->menuItems->map(function ($item) {
                    return $item->title;
                })->join(', ');
            }

            if (!sizeof($result[$table->id])) {
                continue;
            }

            $result[$table->id]['table'] = $table->title;
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
            'food',
            'user',
        ];
    }

    public function columnWidths(): array
    {
       return [
           'A' => 20,
           'B' => 40,
           'C' => 20,
       ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true, 'size' => 16]],
        ];
    }
}
