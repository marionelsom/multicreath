<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'servicio' => 'required|string|max:255',
            'mensaje' => 'required|string|min:10',
        ]);

        try {
            // Guardar en base de datos
            $contact = Contact::create($validated);

            // Enviar email
            Mail::raw(
                "Nombre: {$validated['nombre']}\n" .
                "Email: {$validated['email']}\n" .
                "Servicio de Interés: {$validated['servicio']}\n" .
                "Mensaje: {$validated['mensaje']}",
                function ($message) use ($validated) {
                    $message->to('info@multicreath.com')
                            ->subject('Nuevo mensaje de contacto desde MULTICREATH')
                            ->from($validated['email'], $validated['nombre']);
                }
            );

            return response()->json([
                'success' => true,
                'message' => '¡Mensaje enviado exitosamente! Te contactaremos pronto.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Hubo un error al enviar el mensaje: ' . $e->getMessage()
            ], 500);
        }
    }
}