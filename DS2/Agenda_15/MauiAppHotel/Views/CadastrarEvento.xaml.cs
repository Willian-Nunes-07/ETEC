using MauiAppHotel.Models;

namespace MauiAppHotel.Views;

public partial class CadastrarEvento : ContentPage
{
	public CadastrarEvento()
	{
		InitializeComponent();

        // Definir restrições de datas
        DateInicio.MinimumDate = DateTime.Today;
        DateTermino.MinimumDate = DateTime.Today;
    }

    private void DateInicio_DateSelected(object sender, DateChangedEventArgs e)
    {
        // Ajusta a data máxima de término para 1 mês após a data de início
        DateTermino.MaximumDate = e.NewDate.AddMonths(1);

        // Se a data de término atual estiver fora do intervalo, ajusta
        if (DateTermino.Date < DateTermino.MinimumDate || DateTermino.Date > DateTermino.MaximumDate)
        {
            DateTermino.Date = e.NewDate;
        }
    }

    private void DateTermino_DateSelected(object sender, DateChangedEventArgs e)
    {
        // Apenas garante que o valor esteja atualizado
    }

    private async void Button_Clicked(object sender, EventArgs e)
    {
        await Navigation.PopAsync(); // Voltar
    }

    private async void Button_Clicked_1(object sender, EventArgs e)
    {
        try
        {
            // Cria o objeto ViewModel com os dados preenchidos
            var eventoVM = new EventoViewModel
            {
                NomeEvento = EntryNomeEvento.Text,
                DataInicio = DateInicio.Date,
                DataTermino = DateTermino.Date,
                NumeroParticipantes = int.Parse(EntryNumeroParticipantes.Text),
                CustoPorParticipante = double.Parse(EntryCustoParticipante.Text)
            };

            // Navega para a nova página passando o ViewModel como BindingContext
            await Navigation.PushAsync(new ExibirEventoPage
            {
                BindingContext = eventoVM
            });
        }
        catch (Exception ex)
        {
            await DisplayAlert("Erro", $"Verifique os dados inseridos.\n{ex.Message}", "OK");
        }
    }
}

// ViewModel simples para transportar os dados
public class EventoViewModel
{
    public string NomeEvento { get; set; }
    public DateTime DataInicio { get; set; }
    public DateTime DataTermino { get; set; }
    public int NumeroParticipantes { get; set; }
    public double CustoPorParticipante { get; set; }

    // Propriedade calculada
    public double ValorTotal => NumeroParticipantes * CustoPorParticipante;
}
