-- Display the average duration of stay (in months) for each property
SELECT ParcelNo, CONCAT(FORMAT(AVG(DATEDIFF(EndOfLease, StartOfLease)/30),0),' month/s') as 'Average Lease Duration'
FROM lease_info
GROUP BY ParcelNo;

-- Display sum of total occupants per property
SELECT ParcelNo, SUM(TotalOccupants) as 'Total Occupants'
FROM lease_info
GROUP BY ParcelNo;

-- Count the active lease in each property
SELECT ParcelNo, COUNT(*) as 'Active Lease'
FROM lease_info l
WHERE CURDATE() < EndOfLease
GROUP BY ParcelNo;

-- Retrieve persons' ID and the number of properties they each own
SELECT OwnerID, COUNT(*) as 'Owned Properties'
FROM property_info
GROUP BY OwnerID;

-- Retrieve persons' ID and the number of properties they each manage
SELECT ManagerID, COUNT(*) as 'Managed Properties'
FROM property_info
GROUP BY ManagerID;

-- Retrieve persons' ID and the number of leases each has
SELECT TenantID, COUNT(*) AS 'LeaseCount'
FROM lease_info
GROUP BY TenantID;