<?php

namespace Database\Seeders;

use App\Models\ToDoList;
use Illuminate\Database\Seeder;

class ToDoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ToDoList::firstOrCreate(['name'=>'E-postası ve şifresi ile daha önceden kayıt olmuş kullanıcı için bir giriş ekranı olacak.']);
        ToDoList::firstOrCreate(['name'=>'Giriş yapan kullanıcı karşısına “Yapılacak İşler” listesi ekranı çıkacak.']);
        ToDoList::firstOrCreate(['name'=>'Aynı ekranda yeni iş oluşturabileceği bir alan olacak.']);
        ToDoList::firstOrCreate(['name'=>'Aynı ekranda “Tamamlanan İşler” i listeleyen ekrana geçebileceği yönlendirme linki
olacak.']);
        ToDoList::firstOrCreate(['name'=>'“Tamamlanan İşler” ekranında “Yapılacak İşler” listesinden tamamlandı olarak
işaretlediği işler listelenecek.']);
        ToDoList::firstOrCreate(['name'=>'Tamamlanan işler tek tek silinebilecek veya tekrar yapılacak işler listesine
gönderilebilecek.']);
        ToDoList::firstOrCreate(['name'=>'BONUS(Opsiyonel) Yapılacak iş listesindeki bir iş düzenlenebilecek.']);
    }
}
