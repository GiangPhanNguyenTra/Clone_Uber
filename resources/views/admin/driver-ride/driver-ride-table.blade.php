@foreach ($rides as $ride)
            <tr>
                <td>{{$ride->ride_id}}</td>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$ride->customer->name}}</strong></td>
                <td>{{$ride->customer->phone}}</td>
                <td>{{$ride->start_location_name}}</td>
                <td>{{$ride->end_location_name}}</td>
                <td>{{$ride->distance}}</td>
                <td>{{$ride->start_time}}</td>
                <td>{{$ride->end_time}}</td>
                <td>
                    <td>{{$ride->status_description}}</td>
                </td>
                <td>{{$ride->price}}</td>
                <td>{{$ride->rating}}</td>
                <td>{{$ride->comment}}</td>
            </tr>
@endforeach