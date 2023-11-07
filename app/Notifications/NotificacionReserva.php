<?php

namespace App\Notifications;

use App\Models\Aula;
use App\Models\reserva;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificacionReserva extends Notification
{
 use Queueable;
 public $reserva;
 public $aulas_asignadas;

 /**
  * Create a new notification instance.
  *
  * @return void
  */
 public function __construct(reserva $reserva, $aulas_asignadas = [])
 {
  $this->reserva         = $reserva;
  $this->aulas_asignadas = $aulas_asignadas;
 }
 /**
  * Get the notification's delivery channels.
  *
  * @param  mixed  $notifiable
  * @return array
  */
 public function via($notifiable)
 {
  return ['mail'];
 }

 /**
  * Get the mail representation of the notification.
  *
  * @param  mixed  $notifiable
  * @return \Illuminate\Notifications\Messages\MailMessage
  */
 public function toMail($notifiable)
 {
  $aulas = '';
  for ($i = 0; $i < count($this->aulas_asignadas); $i++) {
   $aulas .= $this->aulas_asignadas[$i]->aula->nombre . ', ';
   if ($i == count($this->aulas_asignadas) - 1) {
    $aulas = substr($aulas, 0, -2);
   }
  }
  if ($this->reserva->estado == "rechazado") {
   return (new MailMessage)
    ->greeting('Hola ' . $this->reserva->user_rol->usuario->Nombre . '! tu reserva ha sido rechazada.')
    ->subject('Reserva Rechazada')
    ->line('La reserva para  la materia de ' . $this->reserva->materia . ' ha sido rechazada.')
    ->line('Motivo del rechazo: ' . $this->reserva->motivo_rechazo);
  } else if ($this->reserva->estado == "reasignar") {
   return (new MailMessage)
    ->greeting('Hola ' . $this->reserva->user_rol->usuario->Nombre . '! tu reserva será reasignada.')
    ->subject('Aviso importante sobre la reserva')
    ->line('La reserva para  la materia de ' . $this->reserva->materia . ' será reasignada.')
    ->line('Recibirá un correo con la información de la nueva reserva en breve.');
  } else {
   return (new MailMessage)
    ->greeting('Hola ' . $this->reserva->user_rol->usuario->Nombre . '! tu reserva ha sido aceptada.')
    ->subject('Reserva Aceptada')
    ->line('Motivo de la reserva: ' . $this->reserva->motivo)
    ->line('Materia: ' . $this->reserva->materia)
    ->line('Cantidad de estudiantes: ' . $this->reserva->cantE)
    ->line('Aulas asignadas: ' . $aulas)
    ->line('Fecha de la reserva: ' . $this->reserva->fecha_examen)
    ->line('Hora de la reserva: ' . $this->reserva->hora_inicio . ' - ' . $this->reserva->hora_fin);

  }

 }

 /**
  * Get the array representation of the notification.
  *
  * @param  mixed  $notifiable
  * @return array
  */
 public function toArray($notifiable)
 {

  return [
   $this->aula_asignada->aula->nombre,
  ];
 }
}