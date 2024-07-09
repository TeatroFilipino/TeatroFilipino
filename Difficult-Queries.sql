-- Display the count of units per unit type, for a particular property.
SELECT u.UnitTypeID, COUNT(*) as 'Count'
FROM unit_info u, unit_types ut
WHERE ParcelNo = 089479143722 AND u.UnitTypeID = ut.UnitTypeID
GROUP BY UnitTypeID;

-- Display the count of properties owned by a particular person, per property type.
SELECT PropType, COUNT(*) as 'Count'
FROM property_info p, property_types pt
WHERE OwnerID = 1 AND p.PropTypeID = pt.PropTypeID
GROUP BY PropType;

-- Display the number of units belonging in each unit type.
SELECT ut.UnitTypeID, UnitDesc, COUNT(*) as 'Count'
FROM unit_types ut, unit_info u
WHERE ut.UnitTypeID = u.UnitTypeID
GROUP BY pt.UnitTypeID;

-- Display the number of properties belonging in each property type.
SELECT pt.PropTypeID, PropType, COUNT(*) as 'Count'
FROM property_types pt, property_info p
WHERE pt.PropTypeID = p.PropTypeID
GROUP BY PropType
ORDER BY PropTypeID;

-- Display the property types along with the least and greatest number of units in each type.
SELECT PropType, MIN(NoOfUnits) AS least, MAX(NoOfUnits) AS greatest
FROM property_types pt, property_info p
WHERE p.PropTypeID = pt.PropTypeID
GROUP BY pt.PropType
ORDER BY pt.PropTypeID;
