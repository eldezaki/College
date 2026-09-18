package Praktikum;

public class Kendaraan {
    protected String merk;
    protected int kapasitasBahanBakar;

    public void setMerk(String merk) { this.merk = merk; }
    public void setKapasitasBahanBakar(int kapasitas) { this.kapasitasBahanBakar = kapasitas; }
    public void cetakInfo() {
        System.out.println("Merk: " + merk + ", Kapasitas Tangki: " + kapasitasBahanBakar + " Liter");
    }
}