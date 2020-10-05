<?php

namespace NaufalBlazeYT\CalculatorUI;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as C;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;

use pocketmine\utils\Config;
use jojoe77777\FormAPI;
use jojoe77777\FormAPI\SimpleForm;
use jojoe77777\FormAPI\CustomForm;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getLogger()->info(C::GREEN . "[Enabled] Plugin CalculatorUI By NaufalBlaze");
    }

    public function onLoad(){
        $this->getLogger()->info(C::YELLOW . "[Loading] Plugin Sedang Loading");
    }

    public function onDisable(){
        $this->getLogger()->info(C::RED . "[Disable] Plugin Terdapat Error / Butuh FormAPI");
    }

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "cal":
                if($sender instanceof Player){
                    if($sender->hasPermission("calculatorui.command")){
                        $this->CalculatorUI($sender);
                        return true;
                    }else{
                        $sender->sendMessage("§cKamu Tidak Mempunyai Permissions");
                        return true;
                    }

                }else{
                    $sender->sendMessage("§cGunakan Command Dalam Game!");
                    return true;
                } 
        }
    }

    public function CalculatorUI($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) {
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
                break;
                case 1:
                    $this->Tambah($sender);
                break;
                case 2:
                    $this->Kurang($sender);
                break;
                case 3:
                    $this->Kalian($sender);
                break;
                case 4:
                    $this->Bagian($sender);
                break;

                }
            });
            $form->setTitle("§e§lCalculatorUI");
            $form->setContent("§bUntuk Membantu Kalian Dalam Matematika");
            $form->addButton("§cKeluar\n§fTap To Close");
            $form->addButton("§bAdd §f(§a+§f)\n§fTap To Open");
            $form->addButton("§bSub §f(§a-§f)\n§fTap To Open");
            $form->addButton("§bMultiply §f(§a*§f)\n§fTap To Open");
            $form->addButton("§bDivide §f(§a/§f)\n§fTap To Open");
            $form->sendToPlayer($sender);
            return $form;
    }

    public function Tambah($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $form = $api->createCustomForm(function (Player $sender, $data){
                    if($data !== null){
				       $angka1 = (int)$data[1];
                       $angka2 = (int)$data[2];
                       $hasil = $angka1 + $angka2;
                       $sender->sendMessage("§aHasilnya Adalah§f: §b$hasil");
				    }
				});
				$form->setTitle("§b§lAdd §f(§a+§f)");
				$form->addLabel("§eSilakan Tulis Angka Pertama Di Sini:");
				$form->addInput("§bMasukan Angka Pertama Di Sini:", "§f1");
				$form->addInput("§bMasukan Angka Kedua Di Sini:", "§f1");
				$form->sendToPlayer($sender);
    }

    public function Kurang($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $form = $api->createCustomForm(function (Player $sender, $data){
                    if($data !== null){
				       $angka1 = (int)$data[1];
                       $angka2 = (int)$data[2];
                       $hasil = $angka1 - $angka2;
                       $sender->sendMessage("§aHasilnya Adalah§f: §b$hasil");
				    }
				});
				$form->setTitle("§b§lSub §f(§a-§f)");
				$form->addLabel("§eSilakan Tulis Angka Pertama Di Sini:");
				$form->addInput("§bMasukan Angka Pertama Di Sini:", "§f1");
				$form->addInput("§bMasukan Angka Kedua Di Sini:", "§f1");
				$form->sendToPlayer($sender);
    }

    public function Kalian($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $form = $api->createCustomForm(function (Player $sender, $data){
                    if($data !== null){
				       $angka1 = (int)$data[1];
                       $angka2 = (int)$data[2];
                       $hasil = $angka1 * $angka2;
                       $sender->sendMessage("§aHasilnya Adalah§f: §b$hasil");
				    }
				});
				$form->setTitle("§b§lMultiply §f(§a*§f)");
				$form->addLabel("§eSilakan Tulis Angka Pertama Di Sini:");
				$form->addInput("§bMasukan Angka Pertama Di Sini:", "§f1");
				$form->addInput("§bMasukan Angka Kedua Di Sini:", "§f1");
				$form->sendToPlayer($sender);
    }

    public function Bagian($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
	    $form = $api->createCustomForm(function (Player $sender, $data){
                    if($data !== null){
				       $angka1 = (int)$data[1];
                       $angka2 = (int)$data[2];
                       $hasil = $angka1 / $angka2;
                       $sender->sendMessage("§aHasilnya Adalah§f: §b$hasil");
				    }
				});
				$form->setTitle("§b§lDevide §f(§a/§f)");
				$form->addLabel("§eSilakan Tulis Angka Pertama Di Sini:");
				$form->addInput("§bMasukan Angka Pertama Di Sini:", "§f1");
				$form->addInput("§bMasukan Angka Kedua Di Sini:", "§f1");
				$form->sendToPlayer($sender);
    }
}