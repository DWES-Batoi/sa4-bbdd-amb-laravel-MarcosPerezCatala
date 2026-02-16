<?php

namespace App\Services;

use App\Models\Equip;
use App\Models\Partit;

class ClassificacioService
{
    // Retorna posicions per equip (1 = millor)
    public function posicionsPerEquip(): array
    {
        $equips = Equip::all();


        $stats = [];
        foreach ($equips as $e) {
            $stats[$e->id] = [
                'equip_id' => $e->id,
                'punts' => 0,
                'gf' => 0,
                'gc' => 0,
                'dg' => 0,
            ];
        }

        $partits = Partit::all();

        foreach ($partits as $p) {
            $l = $p->local_id;
            $v = $p->visitant_id;

            $gl = (int) $p->gols_local;
            $gv = (int) $p->gols_visitant;


            $stats[$l]['gf'] += $gl;
            $stats[$l]['gc'] += $gv;
            $stats[$v]['gf'] += $gv;
            $stats[$v]['gc'] += $gl;


            if ($gl > $gv) {
                $stats[$l]['punts'] += 3;
            } elseif ($gl < $gv) {
                $stats[$v]['punts'] += 3;
            } else {
                $stats[$l]['punts'] += 1;
                $stats[$v]['punts'] += 1;
            }
        }


        foreach ($stats as &$row) {
            $row['dg'] = $row['gf'] - $row['gc'];
        }
        unset($row);


        $rows = array_values($stats);
        usort($rows, function ($a, $b) {
            return
                $b['punts'] <=> $a['punts'] ?:
                $b['dg'] <=> $a['dg'] ?:
                $b['gf'] <=> $a['gf'] ?:
                $a['equip_id'] <=> $b['equip_id'];
        });


        $finalStats = [];
        foreach ($rows as $i => $row) {
            $row['posicio'] = $i + 1;
            $finalStats[$row['equip_id']] = $row;
        }

        return $finalStats;
    }
}
