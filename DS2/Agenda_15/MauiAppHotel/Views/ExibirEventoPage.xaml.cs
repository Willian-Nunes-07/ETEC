using MauiAppHotel.Models;

namespace MauiAppHotel.Views;

public partial class ExibirEventoPage : ContentPage
{
	public ExibirEventoPage()
	{
		InitializeComponent();
	}

    private async void Button_Clicked(object sender, EventArgs e)
    {
        await Navigation.PopAsync(); // Volta para a página anterior
    }
}