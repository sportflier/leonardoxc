<?
// circle functions

function RangeAirspaceCircle($longitude,$latitude,$i) {
	global $AirspaceCircle;

	list($distance,$tmp1)= DistanceBearing($latitude,$longitude,$AirspaceCircle[$i]->Latitude,$AirspaceCircle[$i]->Longitude,1,0);
    return $distance-$AirspaceCircle[$i]->Radius;
}

function InsideAirspaceCircle($longitude,$latitude,$i) {
  global $AirspaceCircle;
  if (($latitude  > $AirspaceCircle[$i]->bounds->miny) &&
      ($latitude  < $AirspaceCircle[$i]->bounds->maxy) &&
      ($longitude > $AirspaceCircle[$i]->bounds->minx) &&
      ($longitude < $AirspaceCircle[$i]->bounds->maxx)) {

    if (RangeAirspaceCircle($longitude, $latitude, $i)<0) {
      return 1;
    }
  }
  return 0;
}


function FindAirspaceCircle($Longitude,$Latitude) {
  global $AirspaceCircle,$NumberOfAirspaceCircles;

  if($NumberOfAirspaceCircles == 0) return -1;
		
  for($i=0;$i<$NumberOfAirspaceCircles;$i++) {
    if(CheckAirspaceAltitude($AirspaceCircle[$i]->Base->Altitude,$AirspaceCircle[$i]->Top->Altitude)) {
		if (InsideAirspaceCircle($Longitude,$Latitude,$i)) {
		  return $i;
		}
    }
  }
  return -1;
}


function CheckAirspaceAltitude($Base, $Top) {
/*
  double alt;
  if (GPS_INFO->BaroAltitudeAvailable) {
    alt = GPS_INFO->BaroAltitude;
  } else {
    alt = GPS_INFO->Altitude;
  }

  switch (AltitudeMode)
    {
    case ALLON : return TRUE;
		
    case CLIP : 
      if(Base < ClipAltitude)
	return TRUE;
      else
	return FALSE;

    case AUTO:
      if( ( alt > (Base - AltWarningMargin) ) 
	  && ( alt < (Top + AltWarningMargin) ))
	return TRUE;
      else
	return FALSE;

    case ALLBELOW:
      if(  (Base - AltWarningMargin) < alt )
	return  TRUE;
      else
	return FALSE;
    case INSIDE:
      if( ( alt >= (Base) ) && ( alt < (Top) ))
	return TRUE;
      else
	return FALSE;
    }
  return TRUE;
*/
return 1;
}

///////////////////////////////////////////////////

// Copyright 2001, softSurfer (www.softsurfer.com)
// This code may be freely used and modified for any purpose
// providing that this copyright notice is included with it.
// SoftSurfer makes no warranty for this code, and cannot be held
// liable for any real or imagined damage resulting from its use.
// Users of this code must verify correctness for their application.

//    a Point is defined by its coordinates {int x, y;}
//===================================================================

// isLeft(): tests if a point is Left|On|Right of an infinite line.
//    Input:  three points P0, P1, and P2
//    Return: >0 for P2 left of the line through P0 and P1
//            =0 for P2 on the line
//            <0 for P2 right of the line
//    See: the January 2001 Algorithm "Area of 2D and 3D Triangles and Polygons"
function isLeft( $P0, $P1, $P2 ) { // AIRSPACE_POINT P0
    return ( ($P1->Longitude - $P0->Longitude) * ($P2->Latitude - $P0->Latitude)
            - ($P2->Longitude - $P0->Longitude) * ($P1->Latitude - $P0->Latitude) );
}
//===================================================================

// wn_PnPoly(): winding number test for a point in a polygon
//      Input:   P = a point,
//               V[] = vertex points of a polygon V[n+1] with V[n]=V[0]
//      Return:  wn = the winding number (=0 only if P is outside V[])
function wn_PnPoly( $P, $V, $n )  //   AIRSPACE_POINT P, AIRSPACE_POINT* V
{
	$wn = 0;    // the winding number counter

    // loop through all edges of the polygon
    for ($i=0; $i<$n; $i++) {   // edge from V[$i] to V[$i+1]
        if ($V[$i]->Latitude <= $P->Latitude) {         // start y <= P.Latitude
            if ($V[$i+1]->Latitude > $P->Latitude)      // an upward crossing
                if (isLeft( $V[$i], $V[$i+1], $P) > 0)  // P left of edge
                    $wn++;            // have a valid up intersect
        } else {                       // start y > P->Latitude (no test needed)
            if ($V[$i+1]->Latitude <= $P->Latitude)     // a downward crossing
                if (isLeft( $V[$i], $V[$i+1], $P) < 0)  // P right of edge
                    $wn--;            // have a valid down intersect
        }
    }
    return $wn;
}
//===================================================================

function InsideAirspaceArea($longitude,$latitude,$i) {

  global $AirspaceArea,$AirspacePoint;

  $thispoint=new AIRSPACE_POINT() ;
  $thispoint->Longitude = $longitude;
  $thispoint->Latitude = $latitude;

  // first check if point is within bounding box
  if (
      ($latitude  > $AirspaceArea[$i]->bounds->miny)&&
      ($latitude  < $AirspaceArea[$i]->bounds->maxy)&&
      ($longitude > $AirspaceArea[$i]->bounds->minx)&&
      ($longitude < $AirspaceArea[$i]->bounds->maxx)
      ) {

    CheckAirspacePoint($AirspaceArea[$i]->FirstPoint);

    // it is within, so now do detailed polygon test
    if (wn_PnPoly($thispoint, $AirspacePoint[$AirspaceArea[$i]->FirstPoint],$AirspaceArea[$i]->NumPoints-1) != 0) {
      // we are inside the i'th airspace area
      return 1;
    }
  }
  return 0;
}


function FindAirspaceArea($Longitude,$Latitude) {
  global $NumberOfAirspaceAreas,$AirspaceArea ;
  if($NumberOfAirspaceAreas == 0)  return -1;

  for($i=0;$i<$NumberOfAirspaceAreas;$i++) {
    if( CheckAirspaceAltitude($AirspaceArea[$i]->Base->Altitude, $AirspaceArea[$i]->Top->Altitude)) {
		if (InsideAirspaceArea($Longitude,$Latitude,$i)) {
		  return $i;
		}
    }
  }
  // not inside any airspace
  return -1;
}





/////////////////////////////////////////////////////////////////////////////////



?>