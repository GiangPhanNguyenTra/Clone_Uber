@foreach ($drivers as $driver)
            <tr>
                <td>{{$driver->id}}</td>
                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$driver->name}}</strong></td>
                <td>{{$driver->email}}</td>
                <td>{{$driver->phone}}</td>
                <td>
                    @if ($driver->verify == 1)
                        <strong class="text-status-1">đã kích hoạt </strong>
                    @else
                        <strong class="text-status-0">chưa kích hoạt </strong>
                    @endif
                </td>
                <td>
                    @if ($driver->citizenIdentifycard)
                        <a class="btn btn-info btn-sm" href="/admin/driver/{{$driver->id}}/citizen-identifycard">View</a>
                    @else
                        x
                    @endif
                </td>
                <td>
                    @if ($driver->drivingLicense)
                        <a class="btn btn-info btn-sm" href="/admin/driver/{{$driver->id}}/driving-license">View</a>
                    @else
                        x
                    @endif
                </td>
                <td>
                    @if ($driver->vehicle)
                        <a class="btn btn-info btn-sm" href="/admin/driver/{{$driver->id}}/vehicle">View</a>
                    @else
                        x
                    @endif
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="/admin/driver/{{$driver->id}}/ride">Lịch sử cuốc xe</a>
                </td>
                <td>
                    <a class="btn btn-warning  btn-sm" href="/admin/driver/{{$driver->id}}/edit">Edit</a>
                    <a class="btn btn-danger  btn-sm btn-toast-del-driver" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" value="{{$driver->id}}">Delete</a>
                </td>
            </tr>
          @endforeach