## SELECT

1- Selezionare tutti i passeggeri (1000)
2- Selezionare tutti i nomi degli aeroporti, ordinati per nome (100)
SELECT name FROM `airports` ORDER BY name;

3- Selezionare tutti i passeggeri che hanno come cognome 'Bartell' (2)
SELECT \* FROM `passengers` WHERE lastname = 'Bartell';

4- Selezionare tutti i passeggeri minorenni (considerando solo l'anno di nascita) (117 - nel 2022)
SELECT \* FROM `passengers` WHERE year(date_of_birth)>2006;

5- Selezionare tutti gli aerei che hanno piu' di 200 posti (84)
6- Selezionare tutti gli aerei che hanno un numero di posti compreso tra 350 e 700 (30)
SELECT \* FROM `airplanes` WHERE seating_capacity BETWEEN 350 AND 700;

7- Selezionare tutti gli ID dei dipendenti che hanno lasciato almeno una compagnia aerea (31077)--->(8939 Distinct)
SELECT DISTINCT employees.id FROM `employees` JOIN airline_employee ON airline_employee.employee_id = employees.id WHERE layoff_date IS NOT null;

8- Selezionare tutti gli ID dei dipendenti che hanno lasciato almeno una compagnia aerea prima del 2006 (493)---->(445 Distinct)
SELECT DISTINCT employees.id FROM `employees`
JOIN airline_employee ON airline_employee.employee_id = employees.id
WHERE year(layoff_date)<=2006;

9- Selezionare tutti i passeggeri il cui nome inizia con 'Al' (26)
SELECT \* FROM `passengers` WHERE name LIKE "Al%";

10- Selezionare tutti i passeggeri nati nel 1960 (11)
SELECT \* FROM `passengers` WHERE year(date_of_birth) = 1960;

## JOIN

1- Selezionare tutti i passeggeri del volo 70021493-2 (85)
SELECT passengers.id, passengers.name, passengers.lastname, flights.number AS Flight FROM `passengers`
JOIN flight_passenger ON flight_passenger.passenger_id = passengers.id
JOIN flights ON flights.id = flight_passenger.flight_id
WHERE flights.number = '70021493-2';

2- Selezionare i voli presi da 'Shirley Stokes' (61)
SELECT passengers.id, passengers.name, passengers.lastname, flights.number AS Flight FROM `passengers`
JOIN flight_passenger ON flight_passenger.passenger_id = passengers.id
JOIN flights ON flights.id = flight_passenger.flight_id
WHERE passengers.name = "Shirley" AND passengers.lastname ="Stokes";

3- Selezionare tutti i passeggeri che hanno usato come documento 'Passport'(775)
SELECT DISTINCT passengers.name, passengers.lastname FROM passengers
JOIN document_type_passenger ON document_type_passenger.passenger_id = passengers.id
WHERE document_type_passenger.document_type_id = 2;

4- Selezionare tutti i voli con i relativi passeggeri (65296)
SELECT flights.number, passengers.id FROM `flights`
JOIN flight_passenger ON flight_passenger.flight_id = flights.id
JOIN passengers ON passengers.id = flight_passenger.passenger_id;

5- Selezionare tutti i voli che partono da 'Charleneland' e arrivano a 'Mauricestad' (3)
SELECT \* FROM `flights`
JOIN airports ON airports.id = flights.departure_airport_id
WHERE departure_airport_id = 10 AND arrival_airport_id = 95;

<!-- oppure piu semplice -->

SELECT \* FROM `flights`
WHERE departure_airport_id = 10 AND arrival_airport_id = 95;

6- Selezionare tutti gli id dei voli che hanno almeno un passeggero il cui cognome inizia con 'L' (966)
SELECT DISTINCT flights.id FROM `flights`
JOIN flight_passenger ON flight_passenger.flight_id = flights.id
JOIN passengers ON passengers.id = flight_passenger.passenger_id
WHERE passengers.lastname LIKE "L%";

7- Selezionare i dati delle compagnie dove almeno un impiegato si è stato licenziato (286)
SELECT DISTINCT airlines.name FROM `airlines`
JOIN airline_employee ON airline_employee.airline_id = airlines.id
WHERE layoff_date IS NOT null;

8- Selezionare tutti gli aerei che sono partiti almeno una volta dalla città di 'Domingochester' (12)
SELECT DISTINCT model FROM `airplanes`
JOIN flights ON flights.airplane_id = airplanes.id
WHERE departure_airport_id = 37;

<!-- più elaborato ma vantaggioso -->

SELECT DISTINCT model FROM `airplanes`
JOIN flights ON flights.airplane_id = airplanes.id
JOIN airports ON airports.id = flights.departure_airport_id
WHERE airports.city = "Domingochester";

9- Selezionare i dati dei tecnici e gli aerei ai quali questi hanno fatto almeno un intervento di manutenzione (1506)
SELECT employees.name, employees.lastname, airplanes.model AS Airplane FROM `employees`
JOIN employee_maintenance_work ON employee_maintenance_work.employee_id = employees.id
JOIN maintenance_works ON maintenance_works.id = employee_maintenance_work.maintenance_work_id
JOIN airplanes ON airplanes.id = maintenance_works.airplane_id;

10- Selezionare tutti i piloti che hanno viaggiato nel 2021 verso l'aeroporto di 'Abshireland' (4)

<!-- SELECT * FROM `roles`
JOIN employees ON employees.role_id = roles.id
JOIN employee_flight ON employee_flight.employee_id = employees.id
JOIN flights ON flights.id = employee_flight.flight_id
WHERE roles.name = "Pilot" AND year(flights.departure_datetime) = 2021 AND flights.arrival_airport_id = 40; -->

## GROUP BY

1- Contare quanti lavori di manutenzione ha eseguito ogni impiegato (dell'impiegato vogliamo solo l'ID) (1136)
SELECT employee_id, COUNT(\*) FROM `employee_maintenance_work` GROUP BY employee_id;

2- Contare quante volte ogni impiegato ha lasciato una compagnia aerea (non mostrare quelli che non hanno mai lasciato; dell'impiegato vogliamo solo l'ID) (8939)
SELECT employee_id, COUNT(\*) AS Total FROM `airline_employee` WHERE layoff_date GROUP BY employee_id;

3- Contare per ogni volo il numero di passeggeri (del volo vogliamo solo l'ID) (1000)
SELECT flight_id, COUNT(\*) FROM `flight_passenger` GROUP BY flight_id;

4- Ordinare gli aerei per numero di manutenzioni ricevute (da quello che ne ha di piu'; dell'aereo vogliamo solo l'ID) (100)
SELECT airplane_id, COUNT(\*) AS Tot FROM `maintenance_works` GROUP BY airplane_id ORDER BY Tot DESC;

5- Contare quanti passeggeri sono nati nello stesso anno (61)
6- Contare quanti voli ci sono stati ogni anno (tenendo conto della data di partenza) (11)
SELECT year(departure_datetime), COUNT(\*) FROM `flights` GROUP BY year(departure_datetime); -->
