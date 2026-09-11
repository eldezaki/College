package Praktikum;

public class TugasDemo {
    public static void main(String[] args) {
        KipasAngin kipas = new KipasAngin();
        kipas.setMerk("Cosmos");
        kipas.setKecepatan(3);
        kipas.cetakInfo();

        System.out.println("----------------------------------------");

        Lampu lampu = new Lampu();
        lampu.setWarna("Warm White");
        lampu.setDayaWatt(15);
        lampu.cetakInfo();

        System.out.println("----------------------------------------");

        Mobil mobil = new Mobil();
        mobil.setMerk("Toyota");
        mobil.setKapasitasBahanBakar(45);
        mobil.setJumlahPintu(4);
        mobil.toggleAC(true);
        mobil.cetakInfo();

        System.out.println("----------------------------------------");

        Motor motor = new Motor();
        motor.setMerk("Honda");
        motor.setKapasitasBahanBakar(5);
        motor.setJenisTransmisi("Matic");
        motor.setCcMesin(160);
        motor.cetakInfo();
    }
}