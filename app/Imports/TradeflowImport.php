<?php


namespace App\Imports;


use App\Container;
use App\Tradeflow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TradeflowImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row)
        {
            // skip 1st row
            if (!$key) continue;

            // $row[0] = OrderNo
            // $row[1] = Transporter
            // $row[2] = Container
            // $row[3] = PurchaseOrder

            // create container if doesn't exist
            $reference = trim($row[2]);
            $container = Container::firstOrCreate([
                'reference' => $reference,
                'is_valid' => $this->validateContainer($reference)
            ]);

            // create tradeflow if doesn't exist
            $name = $row[3] ? trim($row[3]) : trim($row[0]) . ' ' . trim($row[1]);
            $tradeflow = Tradeflow::firstOrCreate([
                'name' => $name
            ]);

            // attach container to tradeflow if it is valid
            if ($container->is_valid){
                $tradeflow->containers()->syncWithoutDetaching($container);
            }
        }
    }

    /**
     * Valid name should be 4 letters followed by 7 numbers
     * Example: "CAIU 360111-5"
     *
     * @param string $reference
     * @return bool
     */
    protected function validateContainer($reference)
    {
        $regex = '/^[a-zA-Z]{4} [0-9]{6}-[0-9]{1}+$/i';

        return !!preg_match($regex, $reference);
    }
}
