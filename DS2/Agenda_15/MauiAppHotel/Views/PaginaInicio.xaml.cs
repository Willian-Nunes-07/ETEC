using MauiAppHotel.Models;

namespace MauiAppHotel.Views;

public partial class PaginaInicio : ContentPage
{
    App PropriedadesApp;
    public PaginaInicio()
	{
		InitializeComponent();

        PropriedadesApp = (App)Application.Current;
    }

    private async void Button_Clicked(object sender, EventArgs e)
    {
        try
        {
            await Navigation.PushAsync(new ContratacaoHospedagem());
        }
        catch (Exception ex)
        {
            await DisplayAlert("Ops", ex.Message, "OK");
        }
    }
    private async void Button_Clicked_1(object sender, EventArgs e)
    {
        try
        {
            await Navigation.PushAsync(new CadastrarEvento() );
        }
        catch (Exception ex)
        {
            await DisplayAlert("Ops", ex.Message, "OK");
        }
    }

    private async void Button_Clicked_2(object sender, EventArgs e)
    {
        try
        {
            await Navigation.PushAsync(new Sobre());
        }
        catch (Exception ex)
        {
            await DisplayAlert("Ops", ex.Message, "OK");
        }
    }


}