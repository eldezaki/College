package Praktikum;

public class Mobil extends Kendaraan {
    private int jumlahPintu;
    private boolean acAktif;

    public void setJumlahPintu(int pintu) { this.jumlahPintu = pintu; }
    public void toggleAC(boolean status) { this.acAktif = status; }

    @Override
    public void cetakInfo() {
        System.out.print("Mobil -> ");
        super.cetakInfo();
        System.out.println("Jumlah Pintu: " + jumlahPintu + ", AC Aktif: " + acAktif);
    }
}