package Praktikum;

public class Lampu {
    private String warna;
    private int dayaWatt;

    public void setWarna(String warna) {this.warna = warna; }
    public void setDayaWatt(int watt) { this.dayaWatt = watt; }
    public void cetakInfo() {
        System.out.println("Lampu -> Warna: " + warna + ", Daya: " + dayaWatt + " Watt");
    }
}