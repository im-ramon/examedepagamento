<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PgConstante;

class PgConstanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PgConstante::create(['pg' => '- Não recebe -', 'pg_abrev' => '- Não recebe -', 'adic_mil' => 0, 'soldo' => 0, 'adic_disp' => 0, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'GEN EX_NA INATIVIDAD ', 'pg_abrev' => 'Gen Ex Inat', 'adic_mil' => 28, 'soldo' => 14031, 'adic_disp' => 41, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'GENERAL DE EXERCITO', 'pg_abrev' => 'Gen Ex', 'adic_mil' => 28, 'soldo' => 13471, 'adic_disp' => 41, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'GENERAL DE DIVISAO', 'pg_abrev' => 'Gen Div', 'adic_mil' => 28, 'soldo' => 12912, 'adic_disp' => 38, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'GENERAL DE BRIGADA', 'pg_abrev' => 'Gen Bda', 'adic_mil' => 28, 'soldo' => 12490, 'adic_disp' => 35, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'CORONEL', 'pg_abrev' => 'Cel', 'adic_mil' => 25, 'soldo' => 11451, 'adic_disp' => 32, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'TENENTE-CORONEL', 'pg_abrev' => 'TC', 'adic_mil' => 25, 'soldo' => 11250, 'adic_disp' => 26, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'MAJOR', 'pg_abrev' => 'Maj', 'adic_mil' => 25, 'soldo' => 11088, 'adic_disp' => 20, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'CAPITÃO', 'pg_abrev' => 'Cap', 'adic_mil' => 22, 'soldo' => 9135, 'adic_disp' => 12, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'CAPITÃO QAO', 'pg_abrev' => 'Cap QAO', 'adic_mil' => 22, 'soldo' => 9135, 'adic_disp' => 32, 'tipo' => 'especial']);
        PgConstante::create(['pg' => 'PRIMEIRO-TENENTE', 'pg_abrev' => '1º Ten', 'adic_mil' => 19, 'soldo' => 8245, 'adic_disp' => 6, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'PRIMEIRO-TENENTE QAO', 'pg_abrev' => '1º Ten QAO', 'adic_mil' => 19, 'soldo' => 8245, 'adic_disp' => 32, 'tipo' => 'especial']);
        PgConstante::create(['pg' => 'SEGUNDO-TENENTE', 'pg_abrev' => '2º Ten', 'adic_mil' => 19, 'soldo' => 7490, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'SEGUNDO-TENENTE QAO', 'pg_abrev' => '2º Ten QAO', 'adic_mil' => 19, 'soldo' => 7490, 'adic_disp' => 32, 'tipo' => 'especial']);
        PgConstante::create(['pg' => 'ASPIRANTE-A-OFICIAL', 'pg_abrev' => 'Asp Of', 'adic_mil' => 19, 'soldo' => 7315, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'CADETE ULTIMO ANO', 'pg_abrev' => 'Cad último ano', 'adic_mil' => 0, 'soldo' => 1630, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'CADETE 1/2/3 ANO', 'pg_abrev' => 'Cad 1/2/3 ano', 'adic_mil' => 0, 'soldo' => 1334, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'ALUNO CPOR/NPOR/IME', 'pg_abrev' => 'Al CPOR', 'adic_mil' => 0, 'soldo' => 1334, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'ALUNO ES F S', 'pg_abrev' => 'Al ES F S', 'adic_mil' => 0, 'soldo' => 1199, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'ALUNO EPC', 'pg_abrev' => 'Al EPC', 'adic_mil' => 0, 'soldo' => 1199, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'ALUNO EPC 1/2/3', 'pg_abrev' => 'Al EPC 1/2/3', 'adic_mil' => 0, 'soldo' => 1185, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'SUB-TENENTE', 'pg_abrev' => 'S Ten', 'adic_mil' => 16, 'soldo' => 6169, 'adic_disp' => 32, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'PRIMEIRO-SARGENTO', 'pg_abrev' => '1º Sgt', 'adic_mil' => 16, 'soldo' => 5483, 'adic_disp' => 20, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'SEGUNDO-SARGENTO', 'pg_abrev' => '2º Sgt', 'adic_mil' => 16, 'soldo' => 4770, 'adic_disp' => 12, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'SEGUNDO-SARGENTO QE', 'pg_abrev' => '2º Sgt QE', 'adic_mil' => 16, 'soldo' => 4770, 'adic_disp' => 26, 'tipo' => 'especial']);
        PgConstante::create(['pg' => 'TERCEIRO-SARGENTO', 'pg_abrev' => '3º Sgt', 'adic_mil' => 16, 'soldo' => 3825, 'adic_disp' => 6, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'TERCEIRO-SARGENTO QE', 'pg_abrev' => '3º Sgt QE', 'adic_mil' => 16, 'soldo' => 3825, 'adic_disp' => 16, 'tipo' => 'especial']);
        PgConstante::create(['pg' => 'CABO ENGAJADO', 'pg_abrev' => 'Cb Eng', 'adic_mil' => 13, 'soldo' => 2627, 'adic_disp' => 6, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'CABO NAO ENGAJADO', 'pg_abrev' => 'Cb N Eng', 'adic_mil' => 0, 'soldo' => 1078, 'adic_disp' => 6, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'SOLDADO PQDT (ENG)', 'pg_abrev' => 'Sd Esp', 'adic_mil' => 13, 'soldo' => 1926, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'SD 2A CL (CLAR/CORN)', 'pg_abrev' => 'Sd 2A Cl', 'adic_mil' => 13, 'soldo' => 1765, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'SD 3A CL (CLAR/CORN)', 'pg_abrev' => 'Sd 3A Cl', 'adic_mil' => 0, 'soldo' => 1078, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'SOLDADO DO EXERCITO', 'pg_abrev' => 'Sd Eng', 'adic_mil' => 13, 'soldo' => 1765, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'SOLDADO RECRUTA', 'pg_abrev' => 'Sd Rcr', 'adic_mil' => 0, 'soldo' => 1078, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'TAIFEIRO-MOR', 'pg_abrev' => 'TF Mor', 'adic_mil' => 13, 'soldo' => 2627, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'TAIFEIRO 1 CL', 'pg_abrev' => 'TF 1Cl', 'adic_mil' => 13, 'soldo' => 2325, 'adic_disp' => 5, 'tipo' => 'normal']);
        PgConstante::create(['pg' => 'TAIFEIRO 2 CL', 'pg_abrev' => 'TF 2Cl', 'adic_mil' => 13, 'soldo' => 2210, 'adic_disp' => 5, 'tipo' => 'normal']);
    }
}
