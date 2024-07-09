-- Display all properties' parcel number, property address, and owner's name.
SELECT ParcelNo, PropAddress, Name as 'Owner'
FROM property_info p, persons pr
WHERE p.OwnerID = pr.ID;

-- Retrieve the property parcel number, display its property type, number of units, and manager's name.
SELECT ParcelNo, PropType, NoOfUnits, Name as 'Manager'
FROM property_info p, property_types pt, persons pr
WHERE p.PropTypeID = pt.PropTypeID AND p.ManagerID = pr.ID;

-- Display the parcel number, property address, and unit number of each unit belonging to a particular property.
SELECT p.ParcelNo, PropAddress, UnitNo
FROM unit_info u, property_info p
WHERE p.ParcelNo = u.ParcelNo AND p.ParcelNo = 089479143722
ORDER BY UnitNo;

-- Find all information of active leases in a particular property. Display tenant by their name.
SELECT ParcelNo, UnitNo, Name as 'Tenant', StartOfLease, EndOfLease, TotalOccupants
FROM lease_info, persons
WHERE TenantID = ID AND ParcelNo = 129920358510 AND EndOfLease > CURDATE()
ORDER BY UnitNo;

-- Display each unit's parcel number, property address and unit no, sort by the property they belong in.
SELECT u.ParcelNo, PropAddress, UnitNo
FROM property_info p, unit_info u
WHERE p.ParcelNo = u.ParcelNo
ORDER BY ParcelNo;

-- Retrieve each unit's record, along with a description of the unit using the unit type id and description
SELECT u.ParcelNo, UnitNo, CONCAT(u.UnitTypeID, " - ",UnitDesc) as 'Unit Description'
FROM unit_info u, unit_types as ut
WHERE u.UnitTypeID = ut.UnitTypeID;

-- Display all information of leases associated to a particular unit. Display tenant by their name, and sort the records in ascending order by the parcel number, and unit number, and the start of lease date in descending order.
SELECT ParcelNo, UnitNo, Name as 'Tenant', StartOfLease, EndOfLease, TotalOccupants
FROM lease_info, persons
WHERE ParcelNo = 542561022711 AND UnitNo = 122 AND TenantID = ID
ORDER BY ParcelNo ASC, UnitNo ASC, StartOfLease DESC;

-- Display the active lease of a particular unit. Display the tenant by their name.
SELECT ParcelNo, UnitNo, Name as 'Tenant', StartOfLease, EndOfLease, TotalOccupants
FROM lease_info, persons
WHERE ParcelNo = 143552994848 AND UnitNo = 264 AND TenantID = ID AND EndOfLease > CURDATE();

-- Display all lease, showing tenant's name. Sort by parcel number and unit number.
SELECT ParcelNo, UnitNo, Name as 'Tenant', StartOfLease, EndOfLease, TotalOccupants
FROM lease_info, persons
WHERE TenantID = ID
ORDER BY ParcelNo, UnitNo;

-- Display all records in the persons table.
SELECT * 
FROM persons;

-- Display the parcel number of each property a person owns.
SELECT ID, ParcelNo
FROM property_info, persons
WHERE OwnerID = ID;

-- Display the parcel number of each property a person manages.
SELECT ID, ParcelNo
FROM property_info, persons
WHERE ManagerID = ID;

-- Display parcel number, unit number, start and end-of dates of lease associated to a particular person
SELECT ParcelNo, UnitNo, StartOfLease, EndOfLease
FROM lease_info
WHERE TenantID = 15;

-- Retrieve the latest ID used in person records
SELECT MAX(ID) AS 'last_id'
FROM persons;