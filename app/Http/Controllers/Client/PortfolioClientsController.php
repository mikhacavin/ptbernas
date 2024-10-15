<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\PortfolioClients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioClientsController extends Controller
{
    public function update(Request $request, string $id)
    {
        $portfolioClient = PortfolioClients::findOrFail($id);

        $validatedData = $request->validate([
            'title_page' => 'string',
            'title_client' => 'string',
            'title_portfolio' => 'string',
            'subtitle_portfolio' => 'string',
            'image_url' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            if ($portfolioClient->image_url) {
                $imagePath = public_path('storage/' . $portfolioClient->image_url);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $originalName = $request->file('image_url')->getClientOriginalName();
            $imageName = Str::random(10) . '-' . $originalName;
            $image_url = $request->file('image_url')->storeAs('images/portfolioclientspage', $imageName, 'public');
            $validatedData['image_url'] = $image_url;
        }

        $portfolioClient->update($validatedData);

        return redirect()->route('dashboard.clients')->with('success', 'Portfolio Clients updated successfully');
    }
}
